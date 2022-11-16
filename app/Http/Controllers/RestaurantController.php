<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search === "name")
            return Restaurant::all();
        return Restaurant::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'work_time' => 'required|max:255',
        ]);
        return Restaurant::create($request->all());
    }

    public function show($id, Request $request)
    {
        if ($request->embed === "comments")
            return Restaurant::with('comments')->find($id);
        return Restaurant::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'work_time' => 'required|max:255',
        ]);
        $Restaurant = Restaurant::find($id);
        $Restaurant->update($request->all());
        return $Restaurant;
    }

    public function destroy($id)
    {
        return Restaurant::destroy($id) === 0
            ? response(["status" => "failure"], 404)
            : response(["status" => "success"], 200);
    }
}
