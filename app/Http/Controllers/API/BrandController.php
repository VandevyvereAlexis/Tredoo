<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    public function __construct()
    {
        // Seules les actions 'index' et 'show' sont publiques
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }





    public function index()
    {
        $brands = Brand::with('carmodels')->paginate(10);
        return response()->json($brands, 200);
    }





    public function store(StoreBrandRequest $request)
    {
        $this->authorize('store', Brand::class);

        $data = $request->validated();
        $brand = Brand::create($data);

        return response()->json([
            'message' => 'Marque créée avec succès.',
            'brand' => $brand
        ], 201);
    }





    public function show(Brand $brand)
    {
        $brand->load('carModels');

        return response()->json([
            'message' => 'Détails de la marque récupérés avec succès.',
            'brand' => $brand
        ], 200);
    }





    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $data = $request->validated();
        $brand->update($data);

        return response()->json([
            'message' => 'Marque mise à jour avec succès.',
            'brand' => $brand
        ], 200);
    }





    public function destroy(Brand $brand)
    {
        $this->authorize('destroy', $brand);

        $brand->delete();

        return response()->json([
            'message' => 'Marque supprimée avec succès.'
        ], 200);
    }
}
