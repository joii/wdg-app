<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('backend.authen.permission.index', compact('permissions'));

    }// End Method

    public function CreatePermission(){

        $permissions = Permission::all();
        return view('backend.authen.permission.create');

    }// End Method

    public function StorePermission(Request $request){

        $request->validate([
            'name' =>'required',
            'group_name' =>'required',
        ]);

        Permission::create(
            ['name' => $request->name,
             'group_name' => $request->group_name,
             'guard_name' => 'admin',

             ]);

         $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.permission.all_permission')->with($notification);

    }// End Method


     public function EditPermission($id){

        $permission = Permission::find($id);
        return view('backend.authen.permission.edit', compact('permission'));

    }// End Method

    public function UpdatePermission(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' =>'required',
            'group_name' =>'required',
        ]);

         $data =  Permission::find($id);
         $data->name = $request->name;
         $data->group_name = $request->group_name;
         $data->save();

         $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.permission.all_permission')->with($notification);

    }// End Method

    public function DestroyPermission(string $id)
    {
        $data =  Permission::find($id);
        $data->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.permission.all_permission')->with($notification);
    }

    public function AllRole(){

        $data = Role::all();
        return view('backend.authen.role.index', compact('data'));

    }// End Method


    public function CreateRole(){
        return view('backend.authen.role.create');

    }// End Method



    public function StoreRole(Request $request){

        $request->validate([
            'name' =>'required',
        ]);

        Role::create(
            [
             'name' => $request->name,
             'guard_name' => 'admin',
             ]);

         $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.role.all_role')->with($notification);

    }// End Method

    public function EditRole($id){

        $role = Role::find($id);
        return view('backend.authen.role.edit', compact('role'));

    }// End Method


    public function UpdateRole(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' =>'required',
        ]);

         $data =  Role::find($id);
         $data->name = $request->name;
         $data->save();

         $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.role.all_role')->with($notification);

    }// End Method

    public function DestroyRole(string $id)
    {
        $data =  Role::find($id);
        $data->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.authen.role.all_role')->with($notification);
    }

    public function AllRolePermission(){

        $roles = Role::all();
        return view('backend.authen.rolesetup.index', compact('roles'));

    }// End Method


    public function CreateRolePermission(){
        $role = Role::all();
        $permission = Permission::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('backend.authen.rolesetup.create',compact('role','permission','permission_groups'));

    }// End Method

     public function StoreRolePermission(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
           $data['role_id'] = $request->role_id;
           $data['permission_id'] = $item;

           DB::table('role_has_permissions')->insert($data);
        } //end foreach

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );
         return redirect()->route('backend.authen.role.all_role')->with($notification);

    }//End Method

     public function EditRolePermission($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroups();

        return view('backend.authen.rolesetup.edit',compact('role','permissions','permission_groups'));
    }//End Method

    public function UpdateRolePermission(Request $request){

        $role = Role::find($request->id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $permissionNames = Permission::whereIn('id',$permissions)->pluck('name')->toArray();
          $role->syncPermissions($permissionNames);
        }else {
            $role->syncPermissions([]);
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.authen.role.all_role')->with($notification);

     }//End Method

    public function AllAdmins(){

        $admins = Admin::latest()->get();
        return view('backend.authen.admin.index', compact('admins'));
    }

     public function CreatAdmin(){

        $roles = Role::all();
        return view('backend.authen.admin.create', compact('roles'));
    }

    public function StoreAdmin(Request $request){

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
           $role = Role::where('id',$request->roles)->where('guard_name','admin')->first();
           if ($role) {
            $user->assignRole($role->name);
           }
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.authen.admin.index')->with($notification);

    }//End Method

    public function Editadmin($id){
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.authen.admin.edit',compact('roles','admin'));
    }//End Method

    public function UpdateAdmin(Request $request){

        $user = Admin::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'admin';
        $user->status = $request->status;
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
           $role = Role::where('id',$request->roles)->where('guard_name','admin')->first();
           if ($role) {
            $user->assignRole($role->name);
           }
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );
         return redirect()->route('backend.authen.admin.index')->with($notification);


    }//End Method

    public function DestroyAdmin($id){

        $admin = Admin::find($id);
        if (!is_null($admin )) {
            $admin->delete();
        }

        $notification = array(
            'message' => 'ลบข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );
         return redirect()->route('backend.authen.admin.index')->with($notification);

    }//End Method
}
