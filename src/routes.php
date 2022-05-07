<?php
use Codebitz\Yomail\Controllers\EmailController;

if(Config::get('yomail.enabled')){
Route::view($this->app['config']->get('yomail.route'),'yomail::index');
Route::get($this->app['config']->get('yomail.route'),[EmailController::class,'show']);
Route::get($this->app['config']->get('yomail.route').'/emails',[EmailController::class,'index']);
Route::get($this->app['config']->get('yomail.route').'/emails/refresh',[EmailController::class,'refresh']);
Route::delete($this->app['config']->get('yomail.route').'/emails/delete/all',[EmailController::class,'deleteAll']);
Route::post($this->app['config']->get('yomail.route').'/test',[EmailController::class,'test']);
}

?>
