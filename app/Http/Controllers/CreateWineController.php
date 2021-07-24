<?php

namespace App\Http\Controllers;


use App\Models\Wine;
use App\Http\Requests\StoreWineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateWineController extends Controller
{
    public function create(StoreWineRequest $request)
    {
        return Wine::create($request->validated());
    }
}
