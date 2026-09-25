@extends('layouts.app')
@section('title', 'Shop Jewellery · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 pt-6 pb-12">
    <x-section-heading eyebrow="Shop" title="Shop Jewellery" class="!mb-6" />
    
    <form action="{{ url('/shop') }}" method="GET" id="shop-filter-form">
        @if(request('collection_id'))
            <input type="hidden" name="collection_id" value="{{ request('collection_id') }}">
        @endif
        <div class="grid md:grid-cols-4 gap-6 items-start">
            
            <!-- Sidebar Filters -->
            <aside class="md:col-span-1">
                <div class="card p-5 border-0 shadow-sm bg-white rounded-2xl ring-1 ring-gray-100">
                    <h4 class="font-serif font-bold mb-4 text-ink-900 text-base">Category</h4>
                    <div class="space-y-3 text-sm text-ink-900/80">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="" onchange="this.form.submit()" class="accent-gold-600 w-4 h-4" {{ empty(request('category')) ? 'checked' : '' }}> 
                            <span class="group-hover:text-gold-600 transition-colors {{ empty(request('category')) ? 'font-medium text-ink-900' : '' }}">All Categories</span>
                        </label>
                        @foreach($categories as $c)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="{{ $c }}" onchange="this.form.submit()" class="accent-gold-600 w-4 h-4" {{ request('category') == $c ? 'checked' : '' }}> 
                            <span class="group-hover:text-gold-600 transition-colors {{ request('category') == $c ? 'font-medium text-ink-900' : '' }}">{{ $c }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </aside>
            
            <!-- Product Grid -->
            <div class="md:col-span-3">
                <!-- Top Bar -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 bg-white py-3 px-5 rounded-2xl border-0 shadow-sm ring-1 ring-gray-100">
                    <div class="relative w-full sm:max-w-sm flex items-center">
                        <i class="bi bi-search absolute left-4 text-gold-400 font-bold"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search collections..." class="pl-10 pr-24 py-2.5 rounded-full border border-gray-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-gold-400 bg-white shadow-sm transition-all text-ink-900">
                        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-gold-400 text-white px-5 rounded-full text-xs font-bold hover:bg-gold-500 transition-colors">Search</button>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-[10px] text-ink-900/40 uppercase tracking-widest font-bold">Sort by:</span>
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded-full border border-gray-200 text-sm text-ink-900 font-medium bg-white focus:outline-none focus:ring-2 focus:ring-gold-400 shadow-sm cursor-pointer appearance-none pr-8 relative">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </div>
                
                <!-- Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                        @foreach($products as $product)
                        <a href="{{ url('/product/'.$product->id) }}" class="block">
                            <x-product-card 
                                :name="$product->name" 
                                :price="$product->price" 
                                :image="$product->image"
                                :tag="$product->is_featured ? 'Featured' : null"
                            >
                                {{ $product->category }}
                            </x-product-card>
                        </a>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $products->links('pagination::tailwind') }}
                    </div>
                @else
                    <div class="text-center py-20 bg-gold-50/20 rounded-3xl border border-gold-100">
                        <i class="bi bi-search text-4xl text-gold-300 mb-4 inline-block"></i>
                        <h3 class="font-serif text-xl font-semibold text-ink-900 mb-2">No products found</h3>
                        <p class="text-ink-900/60 mb-6">We couldn't find anything matching your search or filters.</p>
                        <a href="{{ url('/shop') }}" class="btn-gold !px-8">Clear Filters</a>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
