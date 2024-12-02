<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function home()
    {
        $heroes = Hero::where('is_active', true)
                     ->orderBy('sequence')
                     ->get();

        $featuredProperties = Property::where('is_featured', true)
                                    ->latest()
                                    ->take(6)
                                    ->get();

        return view('welcome', compact('heroes', 'featuredProperties'));
    }

    public function index()
    {
        $properties = Property::latest()->paginate(12);
        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }
}
