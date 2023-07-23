<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    //Guarded untuk menjaga nilai yang tidak bisa diubah
    protected $guarded = ['id'];

    public function sales(){
        return $this->hasOne(Sales::class);
    }
}
