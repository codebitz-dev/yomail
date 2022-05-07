<?php

namespace Codebitz\Yomail\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codebitz\Yomail\Models\Yomail;
use Config;
use Mail;
use Notification;
use Illuminate\Support\Facades\Storage;
use Codebitz\Yomail\Notifications\testEmail;
use Gate;


class EmailController extends Controller
{


    public function show(){
        if (app()->environment(['production']) && Gate::denies('view-yomail', auth()->user())) {
            return abort('401');
        }
        return view('yomail::index');
    }

    public function index(){
        return Yomail::orderByDesc('id')->paginate(10);
    }

    public function refresh(Request $request){
        $emails = Yomail::where('id','>',$request->timestamp)->orderByDesc('id')->get();
        return ['emails'=>$emails,'count'=>$emails->count()];
    }

    public function deleteAll(Request $request){

        Yomail::truncate();

        if(Storage::exists('public/yomail')){
            Storage::disk('public')->deleteDirectory('yomail');
        }

        return true;
    }

    public function test(){

       return Notification::route('mail', 'test@example.com')->notify(new testEmail());
    }
}
