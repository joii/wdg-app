<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenGraphMetaTags;

class OpenGraphMetaTagsController extends Controller
{
    public function Index()
    {
       $meta_tags = OpenGraphMetaTags::all();
       return view('backend.og_meta_tags.index', compact('meta_tags'));
    }

    public function Create()
    {
        return view('backend.og_meta_tags.create');
    }

    public function Store(Request $request)
    {

        $request->validate([
            'name' => 'required',

          ]);


        OpenGraphMetaTags::create([
            'name' => $request->name,
            'url' => $request->url,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'app_id' => $request->app_id,
            'status' => $request->status,
        ]);

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.og_meta_tag.index')->with($notification);
    }

    public function Edit(String $id)
    {
        $data = OpenGraphMetaTags::where('id',$id)->first();
        return view('backend.og_meta_tags.edit',compact('data'));
    }

    public function Update(Request $request)
    {

        $id = $request->id;
        $data = OpenGraphMetaTags::findOrFail($id);
        $data->name = $request->name;
        $data->url = $request->url;
        $data->type = $request->type;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = $request->image;
        $data->app_id = $request->app_id;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.og_meta_tags.index')->with($notification);
    }

    public function Destroy(String $id)
    {
        $pixel = OpenGraphMetaTags::findOrFail($id);
        $pixel->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.og_meta_tags.index')->with($notification);
    }
}
