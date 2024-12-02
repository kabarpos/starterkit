@extends('layouts.app')

@section('title', 'Properties')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                    <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Types</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="villa" {{ request('type') == 'villa' ? 'selected' : '' }}>Villa</option>
                    </select>
                </div>
                <div>
                    <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <select name="price_range" id="price_range" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Any Price</option>
                        <option value="0-100000" {{ request('price_range') == '0-100000' ? 'selected' : '' }}>Under $100,000</option>
                        <option value="100000-300000" {{ request('price_range') == '100000-300000' ? 'selected' : '' }}>$100,000 - $300,000</option>
                        <option value="300000-500000" {{ request('price_range') == '300000-500000' ? 'selected' : '' }}>$300,000 - $500,000</option>
                        <option value="500000+" {{ request('price_range') == '500000+' ? 'selected' : '' }}>$500,000+</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition">
                        Search Properties
                    </button>
                </div>
            </form>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($properties as $property)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="relative">
                        <img src="{{ $property->getFirstMediaUrl() ?: 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914' }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-48 object-cover">
                        @if($property->is_featured)
                            <div class="absolute top-2 left-2 bg-blue-600 text-white px-2 py-1 rounded-md text-sm font-semibold">
                                Featured
                            </div>
                        @endif
                        <div class="absolute top-2 right-2 bg-white/90 px-2 py-1 rounded-md text-sm font-semibold">
                            {{ $property->type }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $property->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($property->description, 100) }}</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                {{ $property->bedrooms }} Beds
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                {{ $property->bathrooms }} Baths
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($property->price) }}</span>
                            <a href="{{ route('properties.show', $property->slug) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                View Details
                                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <h3 class="text-xl font-semibold text-gray-600">No properties found matching your criteria</h3>
                    <p class="mt-2 text-gray-500">Try adjusting your search filters</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $properties->links() }}
        </div>
    </div>
@endsection
