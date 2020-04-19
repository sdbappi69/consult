<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $service;

    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        return $this->service->index($request);
    }

    public function store(Request $request){
        return $this->service->store($request);
    }

    public function update(Request $request, $id){
        return $this->service->update($request, $id);
    }
}
