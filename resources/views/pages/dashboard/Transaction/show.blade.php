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
                            <a href="{{route('dashboard.transaction.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-500 md:ml-2 dark:text-gray-400 dark:hover:text-gray">Transaction</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{$transaction->id}} {{$transaction->name}}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudTable').dataTable(
                {
                    ajax: {
                        'url': '{!! url()->current() !!}'
                    },
                    columns: [
                            {data: 'id', name: 'id', width: '20%'},
                            {data: 'product.title', name: 'product.title'},
                            {data: 'product.price', name: 'product.price'},
                    ],
                }
            )
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight mb-3">
                Transaction Details
            </h1>
            <div class="shadow ofervlow-hidden sm:rounded-lg w-3/4 mb-5 mx-auto rounded-lg">
                <div class="text-dark bg-white border-b border-gray-200 p-6 rounded-lg">
                    <table class="table-auto w-3/4 mx-auto">
                        <tbody>
                            <tr>
                                <th class="border px-6 py-4">Name</th>
                                <td class="border px-6 py-4">{{$transaction->name}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">Email</th>
                                <td class="border px-6 py-4">{{$transaction->email}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">Courrier</th>
                                <td class="border px-6 py-4">{{$transaction->courrier}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">Total</th>
                                <td class="border px-6 py-4">Rp.{{number_format($transaction->total)}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">Payment</th>
                                <td class="border px-6 py-4">{{$transaction->payment}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">Payment url</th>
                                <td class="border px-6 py-4">{{$transaction->payment_url}}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4">No Telp.</th>
                                <td class="border px-6 py-4">{{$transaction->no_telp}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h2 class="font-semibold text-lg text-gray-700 leading-tight mb-5">
                Transaction Items
            </h2>
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
