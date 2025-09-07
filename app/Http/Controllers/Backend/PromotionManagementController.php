<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PromotionManagementController extends Controller
{
    public function Index(){
         $data = Promotions::all();
         return view('backend.promotions.index', compact('data'));
     }

    public function Create(){
        return view('backend.promotions.create');
    }

    public function Store(Request $request){
        if ($request->file('image_path')) {

            // Photo resize and save to public directory
            $image = $request->file('image_path');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1200,800)->save(public_path('uploads/promotions/'.$name_gen));
            $save_url = 'uploads/promotions/'.$name_gen;

            // Thumbnail resize and save to public directory
            $thumbnail = $request->file('thumbnail_path');
            $manager = new ImageManager(new Driver());
            $thumbnail_name_gen = hexdec(uniqid()).'.'.$thumbnail->getClientOriginalExtension();
            $img_thumbnail = $manager->read($thumbnail);
            $img_thumbnail->resize(1000,1000)->save(public_path('uploads/promotions/thumbnail/'.$thumbnail_name_gen));
            $thumbnail_save_url = 'uploads/promotions/thumbnail/'.$thumbnail_name_gen;

            Promotions::create([
                'title' => $request->title,
                'description' => $request->description,
                'detail' => $request->detail,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'link_url' => $request->link_url,
                'image_path' => $save_url,
                'thumbnail_path' => $thumbnail_save_url,
                'slug'=> $request->slug,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.promotion.index')->with($notification);
    }

    public function Edit(String $id){
        $data = Promotions::find($id);
        return view('backend.promotions.edit', compact('data'));
    }

    public function Update(Request $request){

        if(!empty($request->image_path))
        {

            // unlink old image
            if(file_exists($request->old_image)){
                unlink($request->old_image);
            }
            // Photo resize and save to public directory
            $image = $request->file('image_path');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(1200,800)->save(public_path('uploads/promotions/'.$name_gen));
            $image_path = 'uploads/promotions/'.$name_gen;


        }else{
            $image_path = $request->old_image;
        }

        if(!empty($request->thumbnail_path))
        {

            // unlink old image
            if(file_exists($request->old_thumbnail)){
                unlink($request->old_thumbnail);
            }
            // Photo resize and save to public directory
            $thumbnail = $request->file('thumbnail_path');
            $manager = new ImageManager(new Driver());
            $thumbnail_name_gen = hexdec(uniqid()).'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail_img = $manager->read($thumbnail);
            $thumbnail_img->resize(1000,1000)->save(public_path('uploads/promotions/thumbnail/'.$thumbnail_name_gen));
            $thumbnail_path = 'uploads/promotions/thumbnail/'.$thumbnail_name_gen;


        }else{
            $thumbnail_path = $request->old_thumbnail;
        }


        $id = $request->id;
        $data = Promotions::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->detail = $request->detail;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->link_url = $request->link_url;
        $data->image_path = $image_path;
        $data->thumbnail_path = $thumbnail_path;
        $data->slug = $request->slug;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

       $data = Promotions::all();
       return view('backend.promotions.index', compact('data'));
    }

    public function Destroy(string $id)
    {
        $promotion = Promotions::findOrFail($id);
        if(file_exists($promotion->thumbnail_path)){
            unlink($promotion->thumbnail_path);
        }
        if(file_exists($promotion->image_path)){
            unlink($promotion->image_path);
        }
        $promotion->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );


        $data = Promotions::all();
       return view('backend.promotions.index', compact('data'))->with($notification);
    }

}
