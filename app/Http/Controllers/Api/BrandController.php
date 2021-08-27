<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\saveBrand;
use App\Http\Requests\updateBrand;
use App\Http\Resources\Brand;
use App\Models\brand_product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = brand_product::where('brand_status', 1)->get();
        return Brand::collection($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(saveBrand $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'brand_name' => 'required',
        //     'brand_desc' => 'required',
        //     'brand_image' =>'required',
        //     'brand_status'=> 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 404);
        // }
        $brands = brand_product::create([
            'brand_name' => $request->brand_name,
            'brand_desc' => $request->brand_desc,
            'brand_image' => $request->brand_image,
            'brand_status' => $request->brand_status,
        ]);
        return response()->json([
            'code' => 201,
            'data' => $brands,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = brand_product::findOrFail($id);
        return response()->json([
            'code' => 200,
            'data' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateBrand $request, $id)
    {
        $brand = brand_product::findOrFail($id);
        $brand->update($request->all());
        return response()->json([
            'code' => 200,
            'data' => 'Cap nhat thanh cong',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = brand_product::findOrFail($id);
        $brands->delete();
        return response()->json([
            'code' => 200,
            'data' => 'Xóa thành công'
        ]);
    }
}
