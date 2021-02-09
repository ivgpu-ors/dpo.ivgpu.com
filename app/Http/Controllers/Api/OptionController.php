<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Option::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $option = Option::create($request->all());
        return response()->json($option);
    }

    /**
     * Display the specified resource.
     *
     * @param Option $option
     * @return JsonResponse
     */
    public function show(Option $option): JsonResponse
    {
        return response()->json($option);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Option $option
     * @return JsonResponse
     */
    public function update(Request $request, Option $option): JsonResponse
    {
        $option->fill($request->all());
        $option->save();

        return response()->json($option);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Option $option
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Option $option): JsonResponse
    {
        $option->delete();

        return response()->json();
    }
}
