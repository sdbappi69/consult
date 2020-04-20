<?php

namespace App\Http\Controllers;

use App\Http\Repositories\LoginUserRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request){
        return $this->user->index($request);
    }
    public function store(Request $request){
        return $this->user->store($request);
    }
    public function update(Request $request,$id){
        return $this->user->update($request,$id);
    }
    public function profile(Request $request){
        return $this->user->profile($request);
    }
    public function profileUpdate(Request $request){
        return $this->user->profileUpdate($request);
    }

    public function userRequest(Request $request){
        return $this->user->userRequest($request);
    }

    public function userRequestUpdate(Request $request, $id){
        return $this->user->userRequestUpdate($request, $id);
    }

    public function userRequestStore(Request $request){
        return $this->user->userRequestStore($request);
    }
}
