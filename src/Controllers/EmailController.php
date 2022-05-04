<?php

namespace Codebitz\Yomail\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codebitz\Yomail\Models\Yomail;
use Config;
use Illuminate\Support\Facades\Storage;


class EmailController extends Controller
{
    public function index(){
        return Yomail::orderByDesc('id')->get();
    }

    public function refresh(Request $request){
        $emails = Yomail::where('id','>',$request->timestamp)->orderByDesc('id')->get();
        return ['emails'=>$emails];
    }

    public function deleteAll(Request $request){

        Yomail::truncate();

        if(Storage::exists('public/yomail')){
            Storage::disk('public')->deleteDirectory('yomail');
        }

        return true;
    }
}
