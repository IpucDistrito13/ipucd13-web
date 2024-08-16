<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Vendor\Permission\Models\Permission as OriginalPermission;


class Permission extends OriginalPermission
{
    use HasFactory;
    protected $fillable = [
        'description',
        'guard_name',
        'roles',
    ];

}
