<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::paginate(10);
        return response()->json($images, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $annonceId = $request->input('annonce_id');
        $newImages = $request->file('images');
        $positions = $request->input('positions', []);

        $existingImagesCount = Image::where('annonce_id', $annonceId)->count();
        $totalImagesCount = $existingImagesCount + count($newImages);

        if ($totalImagesCount > 10) {
            return response()->json(['message' => 'Maximum de 10 images atteint pour cette annonce.'], 422);
        }

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





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de l'image avec sa relation (annonce si nécessaire)
        $image = Image::with('annonce')->find($id);

        // Vérification si l'image existe
        if (!$image) {
            return response()->json([
                'message' => 'Image non trouvée.',
            ], 404);
        }

        // Retour des détails de l'image
        return response()->json([
            'message' => 'Détails de l\'image récupérés avec succès.',
            'image' => $image
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
