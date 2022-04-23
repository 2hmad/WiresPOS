<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $table = "users";
    protected $fillable = [
        "full_name",
        "email",
        "password",
        "phone",
        "branch",
        "role",
        "pic",
        "token"
    ];
    protected $hidden = [];
    public $timestamps = false;
}
