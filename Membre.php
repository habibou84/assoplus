<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membre extends Model
{
    use SoftDeletes;

    
    public function association()
   {
   	return $this->belongsTo('App\Association');
   }


    public function enfants()
    {
        return $this->hasMany('App\Enfant');
    }

    public function cotisations()
    {
        return $this->hasMany('App\Cotisation');
    }


    public function nominations()
    {
        return $this->hasMany('App\Nomination');
    }


    public function payements()
    {
        return $this->hasMany('App\Payement');
    }


    public function requetes()
    {
        return $this->hasMany('App\Requete');
    }


    public function exhonerations()
    {
        return $this->hasMany('App\Exhoneration');
    }


    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function depanses()
    {
        return $this->belongsToMany('App\Depanse');
    }


}
