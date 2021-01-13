<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\feelings
 */
class Counselors extends Model
{
    //
    public $fillable = ['first_name', 'last_name', 'email'];

    public function Feelings(){
        return $this ->belongsTo(Feelings::class);
    }
}

