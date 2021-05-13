<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Areas extends Model
{
    use SoftDeletes;

    protected $table = 'areas';

    protected $fillable = ['name','acronym'];

    protected $dates = ['deleted_at'];
}
