<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\feelings
 */
class Feelings extends Model
{
    //
    public $fillable = ['student_id', 'score', 'comment'];

    public function Counselors(){
        return $this ->hasMany(Counselors::class);
    }
}

