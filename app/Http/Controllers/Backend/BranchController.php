<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
        public function Index(){
            $data = Branch::latest()->get();
            return view('backend.branch.index', compact('data'));
        }

        public function Create(){
            return view('backend.branch.create');
        }

        public function Store(Request $request){
              $request->validate([
                'name' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'status' => 'required',

              ]);

              Branch::create([
                'name' => $request->name,
                'location' => $request->location,
                'phone' => $request->phone,
                'sms_phone' => $request->sms_phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => $request->status,
            ]);

            $notification = array(
                'message' => 'บันทึกข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('backend.branch.index')->with($notification);
        }

        public function Edit(String $id){
            $data = Branch::find($id);
            return view('backend.branch.edit', compact('data'));
        }

        public function Update(Request $request){
            $id = $request->id;
            $data = Branch ::findOrFail($id);
            $data->name = $request->name;
            $data->location = $request->location;
            $data->phone = $request->phone;
            $data->sms_phone = $request->sms_phone;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->status = $request->status;
            $data->save();

            $notification = array(
                'message' => 'บันทึกข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('backend.branch.index')->with($notification);
        }

        public function Destroy(string $id)
        {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            $notification = array(
                'message' => 'ลยข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('backend.branch.index')->with($notification);
        }

}
