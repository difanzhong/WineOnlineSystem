<?php

namespace App\Http\Controllers;

use App\Models\AddressesResource;
use Illuminate\Http\Request;

class AddressesResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 搜索 中国 地址库 共5个级
    public function index(Request $request)
    {
        // 找到所有 省 及 直辖市
        $addresses = AddressesResource::where('level', 1)->get();

        // 通过 父级代码 ( 上级的 code 成为 下级的 pcode ) 找到 下级地址
        if ( ($request->pcode != 0 || $request->pcode != null) && ($request->level != 0 || $request->level != null) ) {
                $addresses = AddressesResource::where('level', '=', ++$request->level)->where('pcode', '=', $request->pcode)->get();
            }

        return $addresses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
