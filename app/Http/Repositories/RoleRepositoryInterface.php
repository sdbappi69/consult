<?php

namespace App\Http\Repositories;

interface RoleRepositoryInterface
{
    function index($request);
    function create($request);
    function edit($request,$id);
    function update($request,$id);
    function store($request);
}