<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function getRecords(){
        $users = User::paginate(20);
        return new UserCollection($users);
    }
}
