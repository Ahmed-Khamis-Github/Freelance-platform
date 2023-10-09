<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public static $wrap = 'User'  ;


    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->title ,
            'category_name'=>$this->category->name  ?? '',
            'description'=>$this->description ,
            'status'=>$this->status ,
            'type'=>$this->type 
        ] ;

        
    }
}
