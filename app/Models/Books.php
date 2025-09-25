<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'book_code',
        'book_title',
        'author',
        'publisher',
        'status',
        'year',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class,'book_id','id');
    }
}
