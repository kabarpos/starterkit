@extends('layouts.app')

@section('title', $property->title)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Property Images Gallery -->
            <div class="relative h-[500px]">
                <div class="swiper-container h-full" x-data="{ swiper: null }" x-init="swiper = new Swiper($el, {
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    }
                })">
                    <div class="swiper-wrapper">
                        @foreach($property->getMedia() as $media)
                            <div class="swiper-slide">
                                <img src="{{ $media->getUrl() }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <!-- Property Details -->
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $property->title }}</h1>
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-blue-600">${{ number_format($property->price) }}</p>
                        <p class="text-gray-600">{{ $property->type }}</p>
                    </div>
                </div>

                <!-- Property Features -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Bedrooms</p>
                            <p class="font-semibold">{{ $property->bedrooms }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Bathrooms</p>
                            <p class="font-semibold">{{ $property->bathrooms }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Land Size</p>
                            <p class="font-semibold">{{ $property->land_size }} sqft</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="font-semibold">{{ ucfirst($property->status) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Description</h2>
                    <div class="prose max-w-none">
                        {{ $property->description }}
                    </div>
                </div>

                <!-- Features -->
                @if($property->features)
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold mb-4">Features</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach(json_decode($property->features) as $feature)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Contact Form -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">Interested in this property?</h2>
                    <form action="{{ route('property.inquiry', $property->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" required 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" required 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" id="message" rows="4" required 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition">
                                Send Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @endpush
@endsection
