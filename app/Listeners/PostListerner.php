<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostNotificacion;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\User;

use Carbon\Carbon;

class PostListerner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //

          /*
        //User::all()
        //->except($post->user_id)
        //->each(function(User $user) use ($post){
         //   $user->notify(new  PostNotification($post));
       // });
        */
        //Aumentado codigo

        $valor=0;

        
        //$dia = Carbon\Carbon::now();
        $dia = Carbon::now(); 
        //obtenemos el primer registro
        $registro   =   User::where("id",1000)->first();
        //se obtiene el primer registro del id admistrador
        //$registro->id;
        //obtenemos el emial del administrador
       // $registro->email;
       $users = User::all();
       //Saturday
       //Monday
       if($dia->isoFormat('dddd')=='Monday')
        {

      

                 //Condigo para enviar notificaciones dentro la interfaz
            User::all()
            // ->except($event->post->user_id)
             ->each(function(User $user) use ($event){
              if($user->email=='admin@gmail.com'){
              }else{
               if($user->enviado==0){
                 Notification::send($user, new PostNotificacion($event->post));
                  // Notification::send($users, new InvoicePaid($invoice)); 
                }
              }
            });
              //codigo para enviar correos
              /*
             //Mail::send('emails.primeiro',[], function($message){ 
              
                 $enderecos = ['almanzaisrael75@gmail.com','chevycheluis@gmail.com'];
                  
                 $message->to($enderecos);
                 $message->subject('Notificacion');
            // });
               */ 
             
             foreach($users as $user){
                 Mail::send('emails.primeiro',['user' => $user ], function($message) use ($user){ 
                                  //$enderecos = ['almanzaisrael75@gmail.com','chevycheluis@gmail.com'];
                      if($user->email=='admin@gmail.com')
                      {
                      }else
                      {
                        if($user->enviado==0){

                      
                          $message->to($user->email);
                          $message->subject('Formulario');

                          $user->enviado =1;
                          $user->save();

                        }
                      }
                });                   
               } 
        }else{
           //dia miercoles verficamos si el usaario no envio el formulario 
           //Saturday
           //Wednesday
           if($dia->isoFormat('dddd')=='Wednesday')
           {
            foreach($users as $user){
             
                   if($user->email=='admin@gmail.com')
                   {
                   }else
                   {
                     if($user->enviado==1){
                       $user->enviado =0;
                       $user->save();

                     }
                   }
                               
            } 

           }
       
         

        }

           

          
        

     }
      
 
}
