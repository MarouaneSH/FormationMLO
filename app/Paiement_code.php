<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement_code extends Model
{
    public $timestamps = false;
    public function User()
    {
        return $this->hasOne("App\User",'paiement_id',"id");
    }
}
