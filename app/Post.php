<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post_body', 'user_id'];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function($model){
    //         $model->post_body=encrypt_string($model->post_body);
           
    //     });
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
