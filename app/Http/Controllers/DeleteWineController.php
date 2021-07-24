<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWineRequest;
use App\Models\Wine;
use Illuminate\Http\Request;

class DeleteWineController extends Controller
{
    public function delete(StoreWineRequest $wine)
    {
        return Wine::findOrFail($wine->id)->delete($wine->toArray());
    }
}
