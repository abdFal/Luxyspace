<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
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
                            {data: 'id', name: 'id', width: '5%'},
                            {data: 'title', name: 'title'},
                            {data: 'price', name: 'price'},
                            {data: 'qty', name: 'qty'},
                            {data: 'action', name: 'action', orderable: false, searchable: false, width: '25%'}
                    ],
                }
            )
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{route('dashboard.product.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow-lg">+ Add  New Product</a>
            </div>
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
