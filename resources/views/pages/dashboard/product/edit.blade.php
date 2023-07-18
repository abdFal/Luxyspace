<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{route('dashboard.index')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-500 dark:text-gray-400 dark:hover:text-gray">
                            <i class="fa-solid fa-hand-middle-finger px-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{route('dashboard.product.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-500 md:ml-2 dark:text-gray-400 dark:hover:text-gray">Product</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit Product</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{$product->title}}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="md-5" role="alert">
                        <div class="bg-red-600 text-white font-bold rounded-t px-4 py-2">
                            There is something wrong
                        </div>
                        <div class="bg-red-200 text-red-800 px-4 py-3 rounded-b shadow-md mt-0">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="shadow overflow-hidden sm-rounded-md">
                    <h2 class="text-2xl px-4 py-2 text-gray-500 font-bold">Edit product</h2>
                <div class="px-4 py-5 bg-white sm:p-6">
                <form action="{{route('dashboard.product.update', $product->id)}}" class ="w-full" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full px-3">
                            <label for="title" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2">title</label>
                            <input type="text" placeholder="Product title..." value="{{old('title') ?? $product->title}}" name="title" class="block w-full bg-gray-200 text-gray-600 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-light focus:bg-gray-100">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2">Description</label>
                            <textarea id="description" placeholder="Product Desc..." name="description" class="block w-full bg-gray-200 text-gray-600 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-light focus:bg-gray-100">{!! old('description') ?? $product->description !!}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full px-3">
                            <label for="price" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2">Price</label>
                            <input type="number" placeholder="Product Price..." value="{{old('price') ?? $product->price}}" name="price" class="block w-full bg-gray-200 text-gray-600 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-light focus:bg-gray-100">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full px-3">
                            <label for="qty" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2">qty</label>
                            <input type="number" placeholder="Product qty..." value="{{old('qty') ?? $product->qty}}" name="qty" class="block w-full bg-gray-200 text-gray-600 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-light focus:bg-gray-100">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow-lg"> Save</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
    </script>
</x-app-layout>
