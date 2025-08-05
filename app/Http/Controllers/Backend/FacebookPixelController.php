<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacebookPixel;

class FacebookPixelController extends Controller
{
    public function Index()
    {
        $pixels = FacebookPixel::all();
        return view('backend.facebook_pixel.index',compact('pixels'));
    }

    public function Create()
    {
        return view('backend.facebook_pixel.create');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'pixel_name' => 'required',
            'pixel_id' => 'required',
            'domain_scope' => 'required',

          ]);

          FacebookPixel::create([
            'pixel_name' => $request->pixel_name,
            'pixel_id' => $request->pixel_id,
            'domain_scope' => $request->domain_scope,
            'event_script' => $request->event_script,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.facebook_pixel.index')->with($notification);
    }

    public function Edit(String $id)
    {
        $data = FacebookPixel::where('id',$id)->first();
        return view('backend.facebook_pixel.edit',compact('data'));
    }

    public function Update(Request $request)
    {
        $id = $request->id;
        $data = FacebookPixel::findOrFail($id);
        $data->pixel_name = $request->pixel_name;
        $data->pixel_id = $request->pixel_id;
        $data->domain_scope = $request->domain_scope;
        $data->event_script = $request->event_script;
        $data->note = $request->note;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.facebook_pixel.index')->with($notification);
    }

    public function Destroy(String $id)
    {
        $pixel = FacebookPixel::findOrFail($id);
        $pixel->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.facebook_pixel.index')->with($notification);
    }
}
