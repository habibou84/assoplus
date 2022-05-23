<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    //

    
    public function user()
   {
   	return $this->belongsTo('App\User');
   }


   public function membres()
   {
    return $this->hasMany('App\Membre');
   }

   public function incomings()
   {
    return $this->hasMany('App\Incoming');
   }

    public function depanses()
   {
    return $this->hasMany('App\Depanse');
   }


   public function cotisations()
   {
    return $this->hasMany('App\Cotisation');
   }


   public function infos()
   {
    return $this->hasMany('App\Info');
   }

   public function requetes()
   {
    return $this->hasMany('App\Requete');
   }

}
