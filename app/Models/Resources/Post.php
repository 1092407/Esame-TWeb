<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
