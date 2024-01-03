<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public $table = 'product';
    //Guarded untuk menjaga nilai yang tidak bisa diubah
    protected $guarded = ['id'];
    protected $fillable = ['item_produk','jenis_produk','case_produk','bentuk_produk','ukuran_produk'];

    public function stock(){
        return $this->hasOne(Stock::class);
    }

    public function sales_detail(){
       return $this->hasMany(Salesdetail::class);
    }
}
