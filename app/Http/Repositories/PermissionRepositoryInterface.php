<?php

namespace App\Http\Repositories;

interface PermissionRepositoryInterface
{
    function index($request);
    function update($request,$id);
    function store($request);
}