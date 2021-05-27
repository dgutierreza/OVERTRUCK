<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes;

    protected $table = 'users_detail';

    protected $fillable = ['id_user','date_btd','sex','est_civ','adress_dni','adress_home',
'email','email_personal','celphone_pri','celphone_sec','celphone_job','num_childs'];

    protected $dates = ['deleted_at'];
}
