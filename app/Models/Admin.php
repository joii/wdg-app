<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';
    protected $guarded = [];
    protected $guard_name = 'admin';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getpermissionGroups(){
        $permission_group = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_group;
    }

     public static function getpermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
                           ->select('id','name')
                           ->where('group_name', $group_name)->get();

                           return $permissions;
     }

     public static function roleHasPermissions($role,$permissions){
            $hasPermission = true;
            foreach ($permissions as $key => $permission) {
               if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
               }
               return $hasPermission;
            }
    }
}

