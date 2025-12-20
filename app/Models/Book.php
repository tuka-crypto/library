<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $primaryKey = "ISBN";
    public $incrementing =false;
    protected $fillable = [
        'ISBN','title','price','mortgage','authership_date','category_id'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
