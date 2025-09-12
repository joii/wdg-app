<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class BannerController extends Controller
{
    public function Index(){
        $data = Banner::latest()->get();
        return view('backend.banner.index', compact('data'));
    }

    public function Create(){
        return view('backend.banner.create');
    }

    public function Store(Request $request){
        if ($request->file('image_path')) {
            $image = $request->file('image_path');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1920,863)->save(public_path('uploads/banner/'.$name_gen));
            $save_url = 'uploads/banner/'.$name_gen;

            Banner::create([
                'title' => $request->title,
                'alt' => $request->alt,
                'link_url' => $request->link_url,
                'image_path' => $save_url,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.banner.index')->with($notification);
    }

    public function Edit(String $id){
        $data = Banner::find($id);
        return view('backend.banner.edit', compact('data'));
    }

    public function Update(Request $request){
            $id = $request->id;
            $save_url = $request->old_image;

        if ($request->file('image_path')) {

            $image = $request->file('image_path');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1920,863)->save(public_path('uploads/banner/'.$name_gen));
            $save_url = 'uploads/banner/'.$name_gen;



            if(file_exists($request->old_image))
            {
                unlink($request->old_image);
            }

        }

          $data = Banner::find($id);
            $data->title = $request->title;
            $data->alt = $request->alt;
            $data->link_url = $request->link_url;
            $data->image_path = $save_url;
            $data->status = $request->status;
            $data->save();


            $notification = array(
                'message' => 'บันทึกข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('backend.banner.index')->with($notification);
        }


         public function Destroy(string $id)
        {
            $banner = Banner::findOrFail($id);

            if(file_exists($banner->image_path))
            {
                unlink($banner->image_path);
            }

            $banner->delete();

            $notification = array(
                'message' => 'ลยข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('backend.banner.index')->with($notification);
        }



}
