<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarModelRequest;
use App\Http\Requests\UpdateCarModelRequest;
use Illuminate\Support\Facades\Log;

class CarModelController extends Controller
{
    public function index()
    {
        $carModels = CarModel::with('brand')->paginate(10);
        return response()->json($carModels, 200);
    }





    public function store(StoreCarModelRequest $request)
    {
        $data = $request->validated();
        $carModel = CarModel::create($data);

        return response()->json([
            'message' => 'Modèle de voiture créé avec succès.',
            'car_model' => $carModel
        ], 201);
    }





    public function show($id)
    {
        $carModel = CarModel::with('brand')->find($id);

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





    public function update(UpdateCarModelRequest $request, $id)
    {
        // Recherche explicite du modèle
        $carModel = CarModel::find($id);

        if (!$carModel) {
            return response()->json([
                'message' => 'Le modèle de voiture est introuvable.',
            ], 404);
        }

        $data = $request->validated();
        $carModel->fill($data)->save();

        return response()->json([
            'message' => 'Modèle de voiture mis à jour avec succès.',
            'car_model' => $carModel->fresh(),
        ], 200);
    }





    public function destroy(CarModel $carModel)
    {
        //
    }
}
