<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('carmodels')->paginate(10);
        return response()->json($brands, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();

        $brand = Brand::create($data);

        return response()->json([
            'message' => 'Marque créée avec succès.',
            'brand' => $brand
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de la marque avec ses modèles
        $brand = Brand::with('carModels')->find($id);

        // Vérification si la marque existe
        if (!$brand) {
            return response()->json([
                'message' => 'Marque non trouvée.',
            ], 404);
        }

        // Vérification si la marque a des modèles associés
        if ($brand->carModels->isEmpty()) {
            return response()->json([
                'message' => 'Aucun modèle de voiture associé à cette marque.',
                'brand' => $brand
            ], 200);
        }

        // Retour des détails de la marque avec ses modèles
        return response()->json([
            'message' => 'Détails de la marque récupérés avec succès.',
            'brand' => $brand
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
