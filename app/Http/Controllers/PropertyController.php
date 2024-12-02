<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Hero;
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

    public function index(Request $request)
    {
        $query = Property::query();

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by price range
        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            if ($max === '+') {
                $query->where('price', '>=', (int)$min);
            } else {
                $query->whereBetween('price', [(int)$min, (int)$max]);
            }
        }

        $properties = $query->latest()->paginate(9);

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function inquiry(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        // Here you would typically:
        // 1. Save the inquiry to database
        // 2. Send notification emails
        // 3. Handle any other business logic

        return back()->with('success', 'Your inquiry has been sent successfully!');
    }
}
