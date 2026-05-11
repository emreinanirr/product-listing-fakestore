@extends('layouts.app')

@section('content')
<h1 class="text-5xl font-black text-center text-gray-800 tracking-tight pt-16">
    Ürünler
</h1>

<section class="text-gray-700 body-font min-h-screen">
  <div class="container px-5 py-24 mx-auto">


<form method="GET" id="filterForm" class="max-w-3xl mx-auto mb-10">

    <div class="flex flex-wrap md:flex-nowrap shadow-lg rounded-2xl overflow-hidden border border-black bg-yellow-50">

        <input 
            type="search"
            name="search"
            value="{{ request('search') }}"
            class="px-5 py-4 w-full text-sm bg-transparent outline-none placeholder:text-gray-500"
            placeholder="Ürün ara..."
        >

        <select 
            name="category"
            onchange="document.getElementById('filterForm').submit()"
            class="px-5 py-4 bg-yellow-100 border-yellow-200 text-sm outline-none text-gray-700"
        >
            <option value="">Tüm Kategoriler</option>

            @foreach($categories as $cat)
                <option 
                    value="{{ $cat }}"
                    {{ request('category') == $cat ? 'selected' : '' }}
                >
                    {{ ucwords(str_replace(["'", "-"], " ", $cat)) }}
                </option>
            @endforeach
        </select>

        <select 
            name="sort"
            onchange="document.getElementById('filterForm').submit()"
            class="px-5 py-4 bg-yellow-100 border-yellow-200 text-sm outline-none text-gray-700"
        >
            <option value="">Sırala</option>

            <option 
                value="price_asc"
                {{ request('sort') == 'price_asc' ? 'selected' : '' }}
            >
                ↑ Fiyat
            </option>

            <option 
                value="price_desc"
                {{ request('sort') == 'price_desc' ? 'selected' : '' }}
            >
                ↓ Fiyat
            </option>
        </select>

        <button 
            type="submit"
            class="bg-black text-white px-6 hover:bg-yellow-500 hover:text-black transition-all duration-300"
        >
            Ara
        </button>

    </div>

</form>


    <div class="flex flex-wrap -m-4">

      @foreach($products as $product)
        <div class="lg:w-1/4 md:w-1/2 p-4 w-full group">
  <div class="border-2 border-gray-100 rounded-2xl overflow-hidden transition-shadow hover:shadow-lg bg-white">
    <a class="block relative h-64 bg-gray-50 p-10 overflow-hidden">
      <img 
        src="{{ $product->image }}" 
        class="object-contain object-center w-full h-full block transform transition-transform duration-500 group-hover:scale-105"
      >
    </a>
    <div class="p-6">
      <h3 class="text-indigo-500 text-[10px] font-bold tracking-widest mb-1 uppercase">
        {{ $product->category }}
      </h3>
      <h2 class="text-gray-900 title-font text-base font-semibold line-clamp-2 h-12 mb-3">
        {{ $product->title }}
      </h2>
      <div class="flex items-center justify-between mt-auto">
        <span class="text-lg font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
        <button class="bg-gray-900 text-white p-2 rounded-lg hover:bg-indigo-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
      </div>
    </div>
  </div>
</div>
      @endforeach

    </div>
  </div>
</section>
@endsection