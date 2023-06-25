<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function Settings(){

        $settings= Settings::first();

        return view('backend.settings.setting',compact('settings'));
    
    }

    public function SettingsUpdate(Request $request){
       
        $setting= Settings::first();
        $status= $setting->update([
            'title'=>$request->title,
        'meta_description'=>$request->meta_description,
        'meta_keywords'=>$request->meta_keywords,
        'logo'=>$request->logo,
        'favicon'=>$request->favicon,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'footer'=>$request->footer,
        'facebook_url'=>$request->facebook_url,
        'twitter_url'=>$request->twitter_url,
        'instagram_url'=>$request->instagram_url,
        'google_url'=>$request->google_url,
        'printerest'=>$request->printerest,
        ]);

        if($status){
            return back()->with('success','Setting successfully updated');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }
}
