<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\UserStatus;
use App\Http\Resources\UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($userId)
    {
        return User::findOrFail($userId);
    }
    public function showAll()
    {
        $users = User::with(['department', 'userStatus'])->get();

        foreach ($users as $user) {
            $user->department_name = $user->department->name;
            $user->status_name = $user->userStatus->name;
            $user->makeHidden(['department', 'userStatus']);
        }
        return $users;
    }
    public function showStatus()
    {
        $userStatuses = UserStatus::select('id', 'name')->get();
        return response()->json($userStatuses);
    }
    public function showListStatusUsers()
    {
        $listUser = UserStatus::with('users')->get();
        return response()->json($listUser);

    }
    public function showListDepartmentUsers()
    {
        $listUser = Department::with('users')->get();
        return response()->json($listUser);

    }

    public function create()
    {
        $users_status = UserStatus::select('id as value', 'name as label')->get();
        $departments = Department::select('id as value', 'name as label')->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }
    public function generateQrCode($userId)
    {

        $user = User::with(['department', 'userStatus'])->find($userId);
        $user->department_name = $user->department->name;
        $user->status_name = $user->userStatus->name;
        $userResource = new UserResource($user);
        $userData = $userResource->qrCode(request());
        return $userData;

    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $lastLogin = $user->login_at;
            $user->login_at = now();
            $user->save();
            return response()->json(['message' => 'Đăng nhập thành công', 'user' => $user, 'lastLogin' => $lastLogin]);
        } else {
            return response()->json(['message' => 'Đăng nhập thất bại'], 401);
        }

    }




    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return response()->json(['message' => 'Cập nhật thông tin người dùng thành công']);
    }
    public function uploadFile(Request $request)
    {
        $uploadedFile = $request->file('file');

        if (!$uploadedFile->isValid()) {
            return response()->json(['error' => 'File is not valid'], 400);
        }

        $idUser = $request->input('idUser');

        // Tạo đường dẫn đến thư mục uploads/idUser nếu chưa tồn tại
        $storagePath = public_path('uploads/' . $idUser . '/avatar');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        // Lấy thời gian hiện tại
        $currentDateTime = date('G-i-s_j-n-Y');

        // Đổi tên tệp tin mới dựa trên thời gian và phần mở rộng của tệp tin gốc
        $filename = $currentDateTime . '.' . $uploadedFile->getClientOriginalExtension();

        $uploadedFile->move($storagePath, $filename);

        $user = User::findOrFail($idUser);
        $user->avatar = $filename;
        $user->save();
        return response()->json("Tệp tin đã được tải lên thành công", 200);
    }


    public function getAvatar($idUser)
    {
        // Truy vấn cơ sở dữ liệu để lấy tên tệp tin ảnh từ trường "avatar"
        $user = User::findOrFail($idUser);
        $avatarFileName = $user->avatar;

        // Xây dựng đường dẫn đầy đủ đến tệp tin ảnh trong thư mục lưu trữ (sử dụng ID của người dùng)
        $storagePath = public_path('uploads/' . $idUser . '/avatar');
        $avatarFilePath = $storagePath . '/' . $avatarFileName;

        // Kiểm tra xem tệp tin tồn tại
        if (file_exists($avatarFilePath)) {
            // Tạo một mảng chứa URL của tệp tin ảnh.
            if ($avatarFileName) {
                $data = ['url' => asset('uploads/' . $idUser . '/avatar' . '/' . $avatarFileName)];
            } else {
                $data = null;
            }
            // Chuyển đổi mảng thành JSON và trả về như là một phản hồi JSON
            return response()->json($data);
        } else {
            // Trả về một phản hồi lỗi nếu tệp tin không tồn tại
            return response()->json(['error' => 'Avatar not found'], 404);
        }
    }
    public function uploadDegree(Request $request)
    {
        $uploadedFile = $request->file('file');

        if (!$uploadedFile->isValid()) {
            return response()->json(['error' => 'File is not valid'], 400);
        }

        $idUser = $request->input('idUser');
        $nameUser = $request->input('name');
        $nameUser = str_replace(' ', '_', $nameUser);
        $nameUser = mb_strtolower($nameUser, 'UTF-8');
        $str = strtolower($nameUser); //chuyển chữ hoa thành chữ thường
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        // Tạo đường dẫn đến thư mục uploads/idUser nếu chưa tồn tại
        $storagePath = public_path('uploads/' . $idUser . '/degree');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        // Lấy thời gian hiện tại
        // $currentDateTime = date('G-i-s_j-n-Y');

        // Đổi tên tệp tin mới dựa trên thời gian và phần mở rộng của tệp tin gốc
        $filename = $str . '.' . $uploadedFile->getClientOriginalExtension();

        $uploadedFile->move($storagePath, $filename);

        return response()->json("Tệp tin đã được tải lên thành công", 200);
    }
    public function getDegree($idUser)
    {
        // Xây dựng đường dẫn đầy đủ đến thư mục "degree" của người dùng (sử dụng ID của người dùng)
        $storagePath = public_path('uploads/' . $idUser . '/degree');

        // Kiểm tra xem thư mục "degree" tồn tại
        if (!file_exists($storagePath)) {
            return response()->json(['error' => 'Degree folder not found'], 404);
        }

        // Lấy danh sách tất cả các tệp tin trong thư mục "degree"
        $files = scandir($storagePath);

        // Loại bỏ "." và ".." (các tệp tin và thư mục gốc) khỏi danh sách
        $files = array_diff($files, ['.', '..']);

        // Tạo mảng chứa thông tin về tệp tin ảnh (bao gồm tên và URL)
        $fileData = [];

        foreach ($files as $file) {
            // Loại bỏ hậu tố sau dấu '.'
            $pathInfo = pathinfo($file);
            $fileNameWithoutExtension = $pathInfo['filename'];

            // Thay thế '_' bằng khoảng trắng và viết hoa chữ cái đầu
            $formattedFileName = ucwords(str_replace('_', ' ', $fileNameWithoutExtension));

            $fileData[] = [
                'name' => $formattedFileName,
                // Tên tệp tin đã được định dạng
                'url' => asset('uploads/' . $idUser . '/degree/' . $file) // URL của tệp tin
            ];
        }



        return response()->json(['files' => $fileData]);
    }





}