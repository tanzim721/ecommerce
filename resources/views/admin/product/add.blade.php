<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.head')
    <style>
        input[type="text"],
        input[type="password"],
        input[type="file"] {
            width: 90%;
            height: 40px;
            margin: 0 auto;
        }

        select {
            width: 80%;
            height: 40px;
            margin: 0 auto;
        }

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    @include('admin.layouts.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.layouts.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="div_deg d-inline">
                    <div class="form-group mx-5 ">
                        <!-- TODO: Implement back to previous page link -->
                        <a href="{{ URL::previous() }}" class="btn btn-primary px-3">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    @if ($errors->has('product'))
                        <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('product') }}</strong>
                        </span>
                    @endif
                </div>
                <form action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product))
                        @method('POST')
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="m-2">
                                <label for="category_id"
                                    class="block mb-1 text-sm font-bold text-gray-900 text-light">Category</label>
                                <select name="category_id" id="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            {{ old('category_id', $product->category_id ?? '') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->any())
                                    <div class="alert">
                                        <ul>
                                            <li>{{ $errors->first('category_id') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="m-2">
                                <label for="title"
                                    class="block mb-1 text-sm font-bold text-gray-900 text-light">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $product->title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Title">
                                @if ($errors->any())
                                    <div class="alert mt-4">
                                        <ul>
                                            <li>{{ $errors->first('title') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="description"
                                class="block mb-1 text-sm font-bold text-gray-900 text-light">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $product->description ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Description">
                            @if ($errors->any())
                                <div class="alert mt-4">
                                    <ul>
                                        <li>{{ $errors->first('description') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <label for="image"
                                class="block mb-1 text-sm font-bold text-gray-900 text-light">Images</label>
                            <input type="file" name="image"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" value="{{ old('image', $product->image ?? '') }}">
                            @if ($errors->any())
                                <div class="alert mt-4">
                                    <ul>
                                        <li>{{ $errors->first('image') }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if(isset($product) && $product->image)
                                <img src="{{ asset($product->image) }}" alt="Product Image" class="mt-2" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="price"
                                class="block mb-1 text-sm font-bold text-gray-900 text-light">Price</label>
                            <input type="text" name="price" value="{{ old('price', $product->price ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Price">
                            @if ($errors->any())
                                <div class="alert mt-4">
                                    <ul>
                                        <li>{{ $errors->first('price') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <label for="quantity"
                                class="block mb-1 text-sm font-bold text-gray-900 text-light">Quantity</label>
                            <input type="text" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Quantity">
                            @if ($errors->any())
                                <div class="alert mt-4">
                                    <ul>
                                        <li>{{ $errors->first('quantity') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="status"
                                class="block mb-1 text-sm font-bold text-gray-900 text-light">Status</label>
                            <label class="inline-flex items-center cursor-pointer ps-5 mt-2">
                                <input type="hidden" name="status" value="inactive">
                                <input type="checkbox" name="status" value="active" class="sr-only peer"
                                    {{ old('status', $product->status ?? '') == 'active' ? 'checked' : '' }}>
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="p-2 ms-4 mt-2">
                        <button type="submit" class="btn btn-info">
                            {{ isset($product) ? 'Update' : 'Submit' }}
                        </button>
                    </div>
                </form>

            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this category",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancle) => {
                    if (willCancle) {
                        window.location.href = urlToRedirect;
                    } else {
                        swal("Your Product is safe!");
                    }
                });
        }
    </script>
    @include('admin.layouts.script')
</body>

</html>
