<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $attributes = [
        'status' => 0,
    ];

    protected $fillable = ['name', 'email', 'status', 'group_id'];
}

//Tự liên kết với 1 table trong Database
//User => Table users
//ProductCategory => product_categories


//Giả sử: tên model Phone, table phone
