<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str ;

class Freelancer extends Model
{
    use HasFactory;


    protected $fillable=[
        'first_name','last_name','description','gender','birthday',
        'title','hourly_rate','country','profile_photo_path'
    ] ;

    protected $primaryKey='user_id' ;

    public function user()
    {
        return $this->belongsTo(User::class) ;
    }

    

    
}
