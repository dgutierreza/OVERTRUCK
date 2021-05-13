<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaRoles extends Model
{
    use SoftDeletes;

    protected $table = 'areas_rol';

    protected $fillable = ['name','id_area'];

    protected $dates = ['deleted_at'];
}
