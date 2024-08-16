<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Vendor\Permission\Models\Permission as OriginalPermission;
use Spatie\Permission\Models\Permission as OriginalPermission;


class Permission extends OriginalPermission
{
    use HasFactory;


    protected $fillable = ['name', 'slug', 'http_method', 'http_path', 'descripcion', 'guard_name', 'roles'];

}
