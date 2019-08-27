<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'tb_review_produk';
    protected $fillable = ["rating", "review","produk_id"];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
