<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'posts';

    protected $guarded =[];

    function user(){
        return $this->belongsTo(User::class ,'posted_by','id');
    }

    function category(){
        return $this->belongsTo(Category::class);
    }
}
