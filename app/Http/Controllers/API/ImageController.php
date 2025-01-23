<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::paginate(10);
        return response()->json($images, 200);
    }





    public function store(StoreImageRequest $request)
    {
        // Récupère les données d'entrée
        $annonceId = $request->input('annonce_id');
        $newImages = $request->file('images');
        $positions = $request->input('positions', []);

        // Vérifie la limite de 10 images pour l'annonce
        $existingImagesCount = Image::where('annonce_id', $annonceId)->count();
        $totalImagesCount = $existingImagesCount + count($newImages);
        if ($totalImagesCount > 10) {
            return response()->json(['message' => 'Maximum de 10 images atteint pour cette annonce.'], 422);
        }

        // Traite et stocke chaque image
        foreach ($newImages as $key => $image) {
            $path = $image->store('images', 'public');
            $position = $positions[$key] ?? $existingImagesCount + $key + 1;

            Image::create([
                'annonce_id' => $annonceId,
                'url'        => $path,
                'position'   => $position,
            ]);
        }

        return response()->json(['message' => 'Images téléchargées avec succès.'], 201);
    }





    public function show($id)
    {
        $image = Image::with('annonce')->find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Image non trouvée.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails de l\'image récupérés avec succès.',
            'image' => $image
        ], 200);
    }





    public function update(UpdateImageRequest $request, Image $image)
    {
        $data = $request->validated();

        // Remplace l'image existante
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['url'] = $path;
        }

        // Gère le changement de position si une nouvelle position est spécifiée
        if (isset($data['position'])) {
            $existingImageAtPosition = Image::where('annonce_id', $image->annonce_id)
                ->where('position', $data['position'])
                ->first();

            if ($existingImageAtPosition) {
                // Échange la position avec l'image existante
                $existingImageAtPosition->update(['position' => $image->position]);
            }
        }

        $image->update($data);

        return response()->json([
            'message' => 'Image mise à jour avec succès.',
            'image' => $image
        ], 200);
    }





    public function destroy($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Image non trouvée.',
            ], 404);
        }

        $image->delete();

        return response()->json([
            'message' => 'Image supprimée avec succès.',
        ], 200);
    }
}
