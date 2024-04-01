<x-app-layout>
    <div class="py-12">

        <!-- Search input -->
        <form action="{{ route('pos.filter') }}" method="GET" class="mt-6 mb-6 max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="relative shadow-sm bg-white">
                <input name="search" placeholder="Search by product name or SKU..."
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full appearance-none bg-transparent py-4 pl-4 pr-12 text-base text-slate-900 placeholder:text-slate-600 focus:outline-none sm:text-sm sm:leading-6"
                    aria-label="Search components" id="headlessui-combobox-input-36" role="combobox" type="text"
                    aria-expanded="false" aria-autocomplete="list" data-headlessui-state="" tabindex="0"
                    style="caret-color: rgb(107, 114, 128);">
                <button type="submit" class=" absolute right-4 top-0 h-10 w-10 fill-slate-400 z-40">
                    <svg class="pointer-events-none absolute right-4 top-4 h-6 w-6 fill-slate-400"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.47 21.53a.75.75 0 1 0 1.06-1.06l-1.06 1.06Zm-9.97-4.28a6.75 6.75 0 0 1-6.75-6.75h-1.5a8.25 8.25 0 0 0 8.25 8.25v-1.5ZM3.75 10.5a6.75 6.75 0 0 1 6.75-6.75v-1.5a8.25 8.25 0 0 0-8.25 8.25h1.5Zm6.75-6.75a6.75 6.75 0 0 1 6.75 6.75h1.5a8.25 8.25 0 0 0-8.25-8.25v1.5Zm11.03 16.72-5.196-5.197-1.061 1.06 5.197 5.197 1.06-1.06Zm-4.28-9.97c0 1.864-.755 3.55-1.977 4.773l1.06 1.06A8.226 8.226 0 0 0 18.75 10.5h-1.5Zm-1.977 4.773A6.727 6.727 0 0 1 10.5 17.25v1.5a8.226 8.226 0 0 0 5.834-2.416l-1.061-1.061Z">
                        </path>
                    </svg>
                </button>
            </div>
        </form>


        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">

                    <div class="p-6 text-gray-900 lg:col-span-7">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            {{ __('Product Section') }}
                        </h2>

                        <div id="product-list"
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 xl:gap-x-8 mb-8">

                            @foreach ($products as $product)
                                <div class="group">
                                    <div
                                        class="text-center aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">

                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            class="h-full w-full max-h-[140px] object-cover object-center group-hover:opacity-75">
                                    </div>
                                    <h3 class="text-center mt-4 text-gray-900 font-medium">{{ $product->name }}</h3>
                                    <p class="text-center mt-1 text-lg font-medium">
                                        <!-- Display Discounted Price if any -->
                                        @if ($product->discount > 0)
                                            <span class="discounted-price text-sm text-gray-900">
                                                ${{ number_format($product->selling_price - ($product->selling_price * $product->discount) / 100, 2) }}
                                            </span>
                                            <span
                                                class="original-price line-through text-sm text-gray-500">${{ $product->selling_price }}</span>
                                        @else
                                            <!-- Display Regular Price -->
                                            <span
                                                class="price text-sm text-gray-900">${{ $product->selling_price }}</span>
                                        @endif
                                    </p>
                                    <div class="mt-6">
                                        <form action="{{ route('pos.addToCart', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                                                to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Pagination links -->
                        {{ $products->links() }}

                    </div>

                    <div
                        class="p-6 text-gray-900 mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            {{ __('Billing Section') }}
                        </h2>

                        <div
                            class="relative flex w-full flex-col overflow-hidden bg-white pb-8 pt-6 sm:rounded-lg sm:pb-6 lg:py-8">

                            <section aria-labelledby="cart-heading">
                                <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                    ITEM</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    QTY</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    PRICE</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($cartItems as $cartItem)
                                                <tr>
                                                    <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                                        <div class="flex items-center">
                                                            <div class="h-11 w-11 flex-shrink-0">
                                                                <img class="h-11 w-11"
                                                                    src="{{ asset($cartItem->image) }}" alt="">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="font-medium text-gray-900">
                                                                    {{ $cartItem->name }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                                        <div class="text-gray-900">
                                                            <input type="number" name="quantity"
                                                                class="border-gray-300 max-w-[60px]"
                                                                value="{{ $cart[$cartItem->id] }}"
                                                                data-product-id="{{ $cartItem->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                                        <span
                                                            class="price">${{ number_format($cartItem->selling_price * $cart[$cartItem->id], 2) }}</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                                        <form action="{{ route('pos.deleteCartItem', $cartItem->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="delete-btn border-2 border-rose-500 p-2 rounded-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512" fill="rgb(244 63 94)"
                                                                    height="16" width="16">
                                                                    <path
                                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                                </svg>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                            </section>

                            <section aria-labelledby="summary-heading" class="mt-auto sm:px-6 lg:px-8">
                                <div class="bg-gray-50 p-6 sm:rounded-lg sm:p-8">
                                    <h2 id="summary-heading" class="sr-only">Order summary</h2>

                                    <div class="flow-root">
                                        <dl class="-my-4 divide-y divide-gray-200 text-sm">
                                            <div class="flex items-center justify-between py-4">
                                                <dt class="text-gray-600">Subtotal</dt>
                                                <dd class="font-medium text-gray-900">
                                                    ${{ number_format($subtotal, 2) }}</dd>
                                            </div>
                                            <div class="flex items-center justify-between py-4">
                                                <dt class="text-gray-600">Product Discount</dt>
                                                <dd class="font-medium text-gray-900">
                                                    ${{ number_format($discount, 2) }}</dd>
                                            </div>
                                            <div class="flex items-center justify-between py-4">
                                                <dt class="text-gray-600">Tax</dt>
                                                <dd class="font-medium text-gray-900">${{ number_format($tax, 2) }}
                                                </dd>
                                            </div>
                                            <div class="flex items-center justify-between py-4">
                                                <dt class="text-base font-medium text-gray-900">Total</dt>
                                                <dd class="text-base font-medium text-gray-900">
                                                    ${{ number_format($total, 2) }}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </section>


                            <div class="mt-8 flex justify-end px-4 sm:px-6 lg:px-8">
                                <form action="{{ route('place.order') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full rounded-md border border-transparent bg-teal-400 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 focus:ring-offset-gray-50">
                                        Place Order
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<!-- Update quantity and price script -->
<script>
    document.querySelectorAll('input[name="quantity"]').forEach(function(input) {
        input.addEventListener('change', function() {
            var productId = this.dataset.productId;
            var price = parseFloat(this.closest('tr').querySelector('.price').innerText.replace('$',
                ''));
            var quantity = parseInt(this.value);
            var totalPrice = price * quantity;

            // Update price in the view
            this.closest('tr').querySelector('.price').innerText = '$' + totalPrice.toFixed(2);

            // Update quantity in session cart via AJAX
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('quantity', quantity);

            fetch('/pos/' + productId + '/update-cart-item', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                }
            });
        });
    });
</script>
