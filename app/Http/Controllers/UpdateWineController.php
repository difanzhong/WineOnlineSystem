<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wine;
use App\Http\Requests\StoreWineRequest;

class UpdateWineController extends Controller
{
    public function update(StoreWineRequest $wine)
    {
        return Wine::findOrFail($wine->id)->update($wine->toArray());
    }
}
