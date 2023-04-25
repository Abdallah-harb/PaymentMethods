<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;


class User extends Model
{

    protected $table = "users";
    protected $guarded = [];

    public $timestamps = true;


    public function order(){

        return $this->belongsTo(Offer::class,'user_id','id');
    }
}
