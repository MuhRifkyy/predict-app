<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesdetail extends Model
{
    use HasFactory;
    protected $table = 'salesdetail';
    protected $guarded = [];
    public function sales(){
        return $this->belongsTo(Sales::class);
    }
    public function product(){
        return $this->belongsTo(Produk::class);
    }
}
