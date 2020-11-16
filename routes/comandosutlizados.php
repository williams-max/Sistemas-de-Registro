<?php
Route::get('/test',function(){
    /*
    return Rola::create([
        'name' => 'Admin2',
        'slug' => 'admin2',
        'description' => 'Administrador ',
         'full-access' => 'yes'

    ]);
   
    return Rola::create([
        'name' => 'Guest',
        'slug' => 'guest',
        'description' => 'guest',
         'full-access' => 'no'

    ]);
    
    return Rola::create([
        'name' => 'test',
        'slug' => 'test',
        'description' => 'test',
         'full-access' => 'no'

    ]);
     */

  //   $user = User::find(1000);
   //  $user->rolas()->attach([1,2,3]);
    // $user->rolas()->detach([3]);
//    $user->rolas()->sync([1,2]);

    // return $user;
   /*
    return Permission::create([
        'name' => 'List product',
        'slug' => 'product.index',
        'description' => 'A user can List permission',
    ]);
    */
    $rola = Rola::find(2);

    $rola->permissions()->sync([1,2]);

    return $rola->permissions;
    
});
