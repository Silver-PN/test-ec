<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Branch_Code' => 'PDV',
                'Branch_Name' => 'Chi nhánh Bạch Đằng, Bình Thạnh',
                'Branch_Province' => 'TP,Hồ Chí Minh',
                'Branch_District' => 'Bình Thạnh',
                'Branch_Ward' => 'phường 9',
                'Branch_Street' => '157 Trần Khánh Dư',
                'Branch_Phone' => '0123 486 789',
                'User_Create' => 'uyenthao',
            ],
            [
                'Branch_Code' => 'BD',
                'Branch_Name' => 'Chi nhánh Bà Điểm, Hóc Môn',
                'Branch_Province' => 'TP. Hồ Chí Minh',
                'Branch_District' => 'Hóc Môn',
                'Branch_Ward' => 'Bà Điểm',
                'Branch_Street' => '54/09 Bà Điểm',
                'Branch_Phone' => '0905 123 513',
                'User_Create' => 'uyenthao',
            ],
        ];

        foreach ($data as $branchData) {
            Branch::create($branchData);
        }
    }
}