<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use App\Models\faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function Index(){
        $data = faqs::join('f_a_q_categories', 'f_a_q_categories.id', '=', 'faqs.category_id')
                       ->get(['f_a_q_categories.category_name', 'faqs.*']);
         return view('backend.faqs.index', compact('data'));
     }

     public function Create(){
        $categories = FAQCategory::latest()->get();
        return view('backend.faqs.create',compact('categories'));
    }

    public function Store(Request $request){
        $request->validate([
          'category_id' => 'required',
          'question' => 'required',
          'answer' => 'required',

        ]);

        faqs::create([
          'category_id' => $request->category_id,
          'question' => $request->question,
          'answer' => $request->answer,
          'status' => $request->status,
      ]);

      $notification = array(
          'message' => 'บันทึกข้อมูลสำเร็จ',
          'alert-type' => 'success'
      );

      $data = faqs::join('f_a_q_categories', 'f_a_q_categories.id', '=', 'faqs.category_id')
      ->get(['f_a_q_categories.category_name', 'faqs.*']);
       return view('backend.faqs.index', compact('data'));
    }

    public function Edit(String $id){
        $data = faqs::find($id);
        $categories = FAQCategory::latest()->get();
        return view('backend.faqs.edit', compact('data','categories'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = faqs::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        $data = faqs::join('f_a_q_categories', 'f_a_q_categories.id', '=', 'faqs.category_id')
      ->get(['f_a_q_categories.category_name', 'faqs.*']);
       return view('backend.faqs.index', compact('data'));
    }

    public function Destroy(string $id)
    {
        $faqs = faqs::findOrFail($id);
        $faqs->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        $data = faqs::join('f_a_q_categories', 'f_a_q_categories.id', '=', 'faqs.category_id')
      ->get(['f_a_q_categories.category_name', 'faqs.*']);
       return view('backend.faqs.index', compact('data'));
    }
}
