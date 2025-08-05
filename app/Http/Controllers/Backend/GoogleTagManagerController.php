<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoogleTagManager;

class GoogleTagManagerController extends Controller
{
    public function Index(){
        $gtm_data = GoogleTagManager::latest()->get();

        if($gtm_data->count() > 0){
            $gtm = $gtm_data[0];
        }else{
            $gtm = new GoogleTagManager();
        }
        return view('backend.gtm.index', compact('gtm'));
    }//End Method
    public function GTMStore(Request $request){

        $gtm = GoogleTagManager::latest()->get();

        if($gtm->count() > 0){
            $gtm = GoogleTagManager::findOrFail(1);
            $gtm->gtm_first_block = $request->gtm_first_block;
            $gtm->gtm_second_block = $request->gtm_second_block;
            $gtm->save();

        }else{
            GoogleTagManager::create([
                'gtm_first_block' => $request->gtm_first_block,
                'gtm_second_block' => $request->gtm_second_block,
            ]);
        }


        $notification = array(
            'message' => 'Google Tag Manager Inserted Successfully',
            'alert-type' => 'success'
        );

       // return redirect()->route('backend.metatags.index')->with($notification);
       return view('backend.gtm.index', compact('gtm'));

    }//End method
}
