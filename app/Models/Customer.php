<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $fillable = ['gender','phone','avatar','user_id'];
    public function user(){
    return $this->belongsTo(User::class);
    }
    public function requests(){
        return $this ->hasMany(BookRequest::class);
    }
}
