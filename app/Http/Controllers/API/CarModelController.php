<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarModelRequest;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carModels = CarModel::with('brand')->paginate(10);
        return response()->json($carModels, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelRequest $request)
    {
        $data = $request->validated();
        $carModel = CarModel::create($data);

        return response()->json([
            'message' => 'Modèle de voiture créé avec succès.',
            'car_model' => $carModel
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération du modèle avec la marque
        $carModel = CarModel::with('brand')->find($id);

        // Vérification si le modèle existe
        if (!$carModel) {
            return response()->json([
                'message' => 'Modèle de voiture non trouvé.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails du modèle de voiture récupérés avec succès.',
            'car_model' => $carModel
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        //
    }
}
