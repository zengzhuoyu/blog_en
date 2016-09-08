<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';//指定该模型绑定的是表user（无前缀）
    protected $primaryKey = 'user_id';//主键
    public $timestamps = false;
}
