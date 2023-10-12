<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'Branch_Code',
        'Branch_Name',
        'Branch_Province',
        'Branch_District',
        'Branch_Ward',
        'Branch_Street',
        'Branch_Phone',
        'User_Create',
    ];
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branch';
}