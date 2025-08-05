<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetaTag;


class MetaTagController extends Controller
{
    public function Index(){
        $meta_data = MetaTag::latest()->get();
        $meta = $meta_data[0];
        return view('backend.metatags.index', compact('meta'));
    }//End method

    public function MetaTagStore(Request $request){

        $meta = MetaTag::latest()->get();

        if($meta->count() > 0){
            $meta = MetaTag::findOrFail(1);
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->alt = $request->alt;
            $meta->meta_keyword = $request->meta_keyword;
            $meta->meta_robots = $request->meta_robots;
            $meta->googlebot = $request->googlebot;
            $meta->refresh_content = $request->refresh_content;
            $meta->refresh_url = $request->refresh_url;
            $meta->canonical = $request->canonical;
            $meta->author = $request->author;
            $meta->save();

        }else{
            MetaTag::create([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'alt' => $request->alt,
                'meta_keyword' => $request->meta_keyword,
                'meta_robots' => $request->meta_robots,
                'googlebot' => $request->googlebot,
                'refresh_content' => $request->refresh_content,
                'refresh_url' => $request->refresh_url,
                'canonical' => $request->canonical,
                'author' => $request->author,
            ]);
        }


        $notification = array(
            'message' => 'Meta Tags Inserted Successfully',
            'alert-type' => 'success'
        );

       // return redirect()->route('backend.metatags.index')->with($notification);
       return view('backend.metatags.index', compact('meta'));

    }//End method


}
