<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at','published_at'];
    protected $fillable =[
        'title','decription','content','image','publishes_at','category_id','user_id'
    ];

    /**
     * @return void
     */
    public function deleteImage(){
            Storage::delete($this->image);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {

        return $this->belongsToMany(Tag::class);
    }
   //public function hasTag($tagId)
  // {
       // return in_array($tagId,$this->tags->pluck('id'))->toArray();
   // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopePublished($query)
    {
        return $query->where('publishes_at','<=',  now());
    }
    public function scopeSearched($query)
    {
        $search = request()->query('search');

       if(!$search)
       {
           return $query->published();
       }

        return $query->published()->where('title','LIKE',"%{$search}%");
        //return $query->where('title','LIKE',"%{$search}%");
    }

}
