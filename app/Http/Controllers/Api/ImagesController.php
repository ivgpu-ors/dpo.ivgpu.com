<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Facades\ImageFacade as Img;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $images = [];
        foreach ($request->file('file') as $file) {
            $file = $file->store('images', 'public');
            $srcset = Img::makeSet($file);

            $images[] = Image::create(['file' => $file, 'srcset' => $srcset]);
        }

        return response()->json($images);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return Response
     */
    public function show(Image $image)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Image $image
     * @return Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
