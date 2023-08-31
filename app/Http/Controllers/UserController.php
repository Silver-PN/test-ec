<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    // public function show(string $id)
    // {
    //     return User::findOrFail($id);
    // }
    public function show()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*',
                'departments.name as departments',
                'users_status.name as status'

            )->get();
        // paginate de tao phan trang
        return response()->json($users);
    }
    public function showStatus()
    {
        $users = User::join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users_status.id as id',
                'users_status.name as status'
            )->get();
        // paginate de tao phan trang
        return response()->json($users);
    }
    public function create()
    {
        $users_status = \DB::table("users_status")
            // ->where('users_status.id', '=', 1) 
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        $departments = \DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }
    public function generateQrCode($userId)
    {
        $user = \DB::table("users")
            ->where('users.id', '=', $userId)
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                "users.username as Tài Khoản",
                "users.name as Tên",
                \DB::raw('DATE_FORMAT(users.login_at, "%d/%m/%Y") as Time'),
                // Lấy ngày/tháng/năm từ login_at
                "users.username as Tài Khoản",
                "users.id as ID",
                "users.email",
                'departments.name as Phòng Ban',
                'users_status.name as Trạng Thái'
            )



            ->get();
        return response()->json($user);

    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            $user = Auth::user();
            $lastLogin = $user->login_at;
            $user->login_at = now(); // now() trả về thời gian hiện tại
            $user->save();
            return response()->json(['message' => 'Đăng nhập thành công', 'user' => $user, 'lastLogin' => $lastLogin]);
        } else {
            // Đăng nhập thất bại
            return response()->json(['message' => 'Đăng nhập thất bại'], 401);
        }

    }




    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Lấy dữ liệu từ request và cập nhật vào user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Cập nhật các trường khác tương tự

        // Lưu các thay đổi
        $user->save();

        return response()->json(['message' => 'Cập nhật thông tin người dùng thành công']);
    }
}