<?php

namespace App\Http\Controllers;

use App\Notifications\PostNotificacion;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PostEvent;


use App\User;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
     
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $post = Post::create($data);

        //que se ejcecute si que se enviado un correo ?
       //auth()->user()->notify(new PostNotificacion($post)); 
     
       //ya no usamos esto por que etsamos usando un evento
    // User::all()
     //  ->except($post->user_id)
      // ->each(function(User $user) use ($post){
       //    $user->notify(new  PostNotificacion($post));
       //});

       //event(new PostEvent($post));

        return redirect()->back()->with('message','Notificacion Creada Exitosamente');
   
    }
   
    public function index()
    {
        $postNofications= auth()->user()->unreadNotifications;
        return view('post.notification',compact('postNofications'));
    }
 /*
    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
        ->where($request->input('id'), function($query) use ($request){
            return $query->where('id',$request->input('id'));
        })->markAsRead();
        
        return response()->jnoContent();
        
    }
    */
}
