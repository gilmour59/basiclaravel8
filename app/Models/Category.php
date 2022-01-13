<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'category_name'
    ];

    //one to one
    /* public function user(){
        $this->hasOne(User::class, 'id', 'user_id');
    } */

    //one to many
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
