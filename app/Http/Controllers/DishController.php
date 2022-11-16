<?php

namespace App\Http\Controllers;

use App\Http\Resources\DishCollection;
use App\Models\Dish;
use App\Models\Rating;
use Illuminate\Http\Request;
use Throwable;

class DishController extends Controller
{
    public function index(Request $request)
    {
            return new DishCollection(Dish::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'image' => 'required|max:255',
        ]);
        return Dish::create($request->all());
    }

    public function show($id, Request $request)
    {
        if ($request->embed === "comments")
            return Dish::with('comments')->find($id);
        return Dish::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'image' => 'required|max:255',
        ]);
        $Dish = Dish::find($id);
        $Dish->update($request->all());
        return $Dish;
    }

    public function destroy($id)
    {
        return Dish::destroy($id) === 0
            ? response(["status" => "failure"], 404)
            : response(["status" => "success"], 200);
    }


    public function addRating(Request $request)
    {
        try {
            $request->validate([
                'rating' => 'required|numeric|max:5',
                'dish_id' => 'required|max:250'
            ]);

        } catch (Throwable $e) {
            return response("Rating not added", 400);
        }
        return Rating::create($request->all());
    }
}
