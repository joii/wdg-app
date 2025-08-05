<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{
    public function Index(){
        $data = FAQCategory::latest()->get();
        return view('backend.faq_category.index', compact('data'));
    }

    public function Create(){
        return view('backend.faq_category.create');
    }

    public function Store(Request $request){
        $request->validate([
          'category_name' => 'required',

        ]);

        FAQCategory::create([
          'category_name' => $request->category_name,

      ]);

      $notification = array(
          'message' => 'บันทึกข้อมูลสำเร็จ',
          'alert-type' => 'success'
      );

      return redirect()->route('backend.faq_category.index')->with($notification);
  }

    public function Edit(String $id){
        $data = FAQCategory::find($id);
        return view('backend.faq_category.edit', compact('data'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = FAQCategory ::findOrFail($id);
        $data->category_name = $request->category_name;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.faq_category.index')->with($notification);
    }

    public function Destroy(string $id)
    {
        $branch = FAQCategory::findOrFail($id);
        $branch->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.faq_category.index')->with($notification);
    }


}
