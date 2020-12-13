<?php

namespace App\isarel\Traits;

trait UserTrair {

     public function rolas(){
        return $this->belongsToMany('App\isarel\Models\Rola')->withTimestamps();
    }

    public function havePermission($permission){

        foreach($this->rolas as $rola){
            if($rola['full-access']=='yes'){
                return true;
            }

            foreach($rola->permissions as $perm){

                if($perm->slug == $permission){
                    return true;
                }

            }

        }
        if($rola['full-auto']=='yes'){
            return true;
        }
        return false;
       //return $this->rolas;
    }


}