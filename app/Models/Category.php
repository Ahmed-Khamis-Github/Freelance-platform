<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon ;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes ;

    protected $fillable=[
        'name','slug','description','parent_id','art_path'
    ];

    protected $hidden=[
        'created_at'
    ] ;



    public function projects()
    {
        return $this->hasMany(Project::class) ;
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id','id') ;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id')
        ->withDefault() ;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    
}


