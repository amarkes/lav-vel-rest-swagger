<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['name', 'status'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


}
