<?php

namespace App\Http\Repositories;

interface UserRepositoryInterface
{
    function index($request);
    function update($request,$id);
    function store($request);
    function profile($request);
    function profileUpdate($request);
}