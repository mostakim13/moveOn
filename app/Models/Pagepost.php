<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagepost extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
    }
}