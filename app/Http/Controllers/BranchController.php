<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateBranchRequest;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('created_at', 'desc')->get();
        return response()->json($branches);
    }

    public function show($branch)
    {
        return Branch::findOrFail($branch);
    }

    // public function store(Request $request)
    // {
    //     return DB::transaction(function () use ($request) {
    //         $branch = Branch::create($request->all());
    //         return response()->json($branch, 201);
    //     });
    // }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Branch_Code' => 'required',
            'Branch_Name' => 'required',
            'Branch_Province' => 'required|not_in:0',
            'Branch_District' => 'required|not_in:0',
            'Branch_Street' => 'required',
            'Branch_Phone' => 'required|regex:/^\d{10}$/',
        ]);

        if ($validator->fails()) {
            // return response()->json(['message' => false, 'errors' => $validator->errors()]);
            return response()->json(['message' => false, 'errors' => $validator->errors()->keys()]);

        }


        return DB::transaction(function () use ($request) {
            $branch = Branch::create($request->all());
            return response()->json(['message' => true, 'branch' => $branch]);

        });
    }


    // public function update(Request $request, $branch)
    // {
    //     return DB::transaction(function () use ($request, $branch) {
    //         $data = Branch::findOrFail($branch);
    //         if (!$data) {
    //             return response()->json(['message' => 'Resource not found'], 404);
    //         }

    //         $data->update($request->all());
    //         $data->Branch_Is_Active = $request->input('Branch_Is_Active');
    //         $data->save();
    //         return response()->json($data);
    //     });
    // }
    public function update(Request $request, $branch)
    {
        $validator = Validator::make($request->all(), [
            'Branch_Code' => 'required',
            'Branch_Name' => 'required',
            'Branch_Province' => 'required|not_in:0',
            'Branch_District' => 'required|not_in:0',
            'Branch_Street' => 'required',
            'Branch_Phone' => 'required|regex:/^\d{10}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => false, 'errors' => $validator->errors()->keys()]);
        }

        return DB::transaction(function () use ($request, $branch) {
            $data = Branch::findOrFail($branch);
            if (!$data) {
                return response()->json(['message' => 'Resource not found']);
            }

            $data->update($request->all());
            $data->Branch_Is_Active = $request->input('Branch_Is_Active');
            $data->save();

            return response()->json(['message' => true, 'branch' => $branch]);
        });
    }

    public function destroy(Branch $branch)
    {
        return DB::transaction(function () use ($branch) {
            $branch->delete();
            return response()->json(null, 204);
        });
    }
    public function checkBranchExists($branchCode)
    {
        if ($branchCode) {
            $branch = Branch::where('Branch_Code', 'ILIKE', $branchCode)->first();

            if ($branch) {
                return response()->json(['exists' => true, 'Branch_Name' => $branch->Branch_Name]);
            }
            return response()->json(['exists' => false]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('searchBranch');

        $branches = Branch::where('Branch_Code', 'ILIKE', "%$search%")
            ->orWhere('Branch_Name', 'ILIKE', "%$search%")
            ->orWhere('Branch_Phone', 'ILIKE', "%$search%")
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($branches);
    }




}