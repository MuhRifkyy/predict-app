<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sales_detail(){
        return $this->hasMany(Salesdetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
