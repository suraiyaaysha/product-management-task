<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div role="alert"
                            class="alert alert-danger border border-red-400 rounded bg-red-100 px-4 py-3 text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data"
                        class="max-w-4xl border border-gray-200 p-4 mx-auto mt-10">
                        @csrf


                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                                    Product Name*
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="text" name="name" placeholder="Product Name" required>

                                @error('name')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="sku">Product SKU
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="text" name="sku" placeholder="Product SKU" required>

                                @error('sku')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="selling_price">
                                    Selling Price
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="number" name="selling_price" placeholder="Selling Price" required>
                                @error('selling_price')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="sku">Purchase Price
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="number" name="purchase_price" placeholder="Purchase Price" required>

                                @error('purchase_price')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="discount">
                                    Discount
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="number" name="discount" placeholder="Discount (%)">

                                @error('discount')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="tax">Tax
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="tax" name="tax" placeholder="Tax (%)">

                                @error('discount')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="unit">
                                    Product Unit
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="text" name="unit" placeholder="Product Unit" required>

                                @error('unit')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="unit_value">Product Unit Value
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="text" name="unit_value" placeholder="Product Unit Value" required>
                                @error('unit_value')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="variant_name[]">
                                    Product Variant Name
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="text" name="variant_name[]" placeholder="Variant Name" required>

                                @error('variant_name')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                    for="variant_price[]">Product Variant Price
                                </label>
                                <input
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    type="number" name="variant_price[]" placeholder="Variant Price" required>

                                @error('variant_price')
                                    <div>
                                        <span class="text-red-500 italic">
                                            {{ $message }}
                                        </span>
                                    </div>
                                @enderror

                            </div>

                        </div>

                        <div class="sm:col-span-4">
                            <!-- Variant Values -->
                            <div class="md:w-1/1 variant-values-container">
                                <label for="variant_values"
                                    class="uppercase tracking-wide text-black text-xs font-bold mb-2">Variant
                                    Value</label>
                                <input type="text" name="variant_values[0][]" placeholder="Variant Value" required
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-30">
                            </div>
                        </div>
                        <button type="button"
                            class="mt-2 add-variant-value rounded-md bg-indigo-600 py-3 px-4 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                            Variant Value
                        </button>

                        <div class="sm:col-span-4 mt-8">
                            <label for="image"
                                class="uppercase tracking-wide text-black text-xs font-bold mb-2">Product
                                Image</label>
                            <input type="file" name="image"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-30">
                            @error('image')
                                <div>
                                    <span class="text-red-500 italic">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full rounded-md bg-indigo-600 py-3 px-4 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit
                                Product</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Add variant value input fields dynamically
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('add-variant-value')) {
            const variantValuesContainer = document.querySelector('.variant-values-container');
            const inputField = document.createElement('input');
            inputField.setAttribute('type', 'text');
            inputField.setAttribute('name', `variant_values[${variantValuesContainer.children.length}][]`);
            inputField.setAttribute('placeholder', 'Variant Value');
            inputField.setAttribute('required', 'required');
            inputField.classList.add('w-full', 'mt-1', 'text-black', 'border', 'w-full', 'bg-gray-200',
                'border-gray-200', 'rounded', 'py-3', 'px-4',
                'border-gray-200');
            variantValuesContainer.appendChild(inputField);
        }
    });
</script>
