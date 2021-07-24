<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use App\Http\Resources\WineResource;
use Illuminate\Http\Request;

class ListWinesController extends Controller
{
    protected function index()
    {
        return WineResource::collection(Wine::all());
    }
}
