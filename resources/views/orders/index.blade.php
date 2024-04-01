<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your orders') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto ">
            <div class="p-6 text-gray-900">
                <form action="{{ route('orders.index') }}" method="GET">
                    <div class="flex items-center">
                        <label for="start_date" class="mr-2">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-input rounded-md">
                        <label for="end_date" class="ml-4 mr-2">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-input rounded-md">
                        <button type="submit"
                            class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Apply Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($orders as $order)
                        <div class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border mb-8">
                            <h3 class="sr-only">Order placed on <time
                                    datetime="{{ $order->created_at }}">{{ $order->created_at->format('M j, Y') }}</time>
                            </h3>

                            <div
                                class="flex items-center border-b border-gray-200 p-4 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:p-6">
                                <dl
                                    class="grid flex-1 grid-cols-2 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-2">
                                    <div>
                                        <dt class="font-medium text-gray-900">Order number</dt>
                                        <dd class="mt-1 text-gray-500">{{ $order->id }}</dd>
                                    </div>
                                    <div class="hidden sm:block">
                                        <dt class="font-medium text-gray-900">Date placed</dt>
                                        <dd class="mt-1 text-gray-500">
                                            <time
                                                datetime="{{ $order->created_at }}">{{ $order->created_at->format('M j, Y') }}</time>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="font-medium text-gray-900">Total amount</dt>
                                        <dd class="mt-1 font-medium text-gray-900">
                                            ${{ number_format($order->total, 2) }}</dd>
                                    </div>
                                </dl>

                                <div class="relative flex justify-end lg:hidden">
                                    <div class="flex items-center">
                                        <button type="button"
                                            class="-m-2 flex items-center p-2 text-gray-400 hover:text-gray-500"
                                            id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                            <span class="sr-only">Options for order
                                                {{ $order->id }}</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Products -->
                            <h4 class="sr-only">Items</h4>
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach ($order->products as $product)
                                    <li class="p-4 sm:p-6">
                                        <div class="flex items-center sm:items-start">
                                            <div
                                                class="h-20 w-20 max-h-[100px] max-w-[100px] flex-shrink-0 overflow-hidden rounded-lg bg-gray-200 sm:h-40 sm:w-40">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                    class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="ml-6 flex-1 text-sm">
                                                <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                                    <h5>{{ $product->name }}</h5>
                                                    <p class="mt-2 sm:mt-0">
                                                        ${{ number_format($product->pivot->quantity * $product->selling_price, 2) }}
                                                    </p>
                                                </div>
                                                <p class="hidden text-gray-500 sm:mt-2 sm:block">
                                                    {{ $product->description }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        <p>No orders found.</p>
                    @endforelse

                    <!-- Pagination links -->
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
