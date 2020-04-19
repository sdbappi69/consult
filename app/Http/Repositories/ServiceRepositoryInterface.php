<?php

namespace App\Http\Repositories;

interface ServiceRepositoryInterface
{
    function index($request);
    function update($request,$id);
    function store($request);
}