<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    //

   
   public function membre()
   {
    return $this->belongsTo('App\Membre');
   }

   public function association()
   {
    return $this->belongsTo('App\Association');
   }


}
