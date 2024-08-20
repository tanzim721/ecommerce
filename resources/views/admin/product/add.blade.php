<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.head')
    <style>
        input[type="text"] {
            width: 350px;
            height: 40px;
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
                <form class="mx-5" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1">
                        <label for="title" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="mb-1">
                        <label for="title" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product
                            title</label>
                        <input type="text" id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Titles" />
                    </div>
                    <div class="mb-1">
                        <label for="description" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product
                            description</label>
                        <input type="text" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Description" />
                    </div>
                    <div class="mb-1">
                        <label class="block mb-1 text-sm font-bold text-gray-900 text-light" for="file_input">Upload
                            file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 800x400px).</p>
                    </div>
                    <div class="mb-1">
                        <label for="price" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product
                            price</label>
                        <input type="number" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Price" />
                    </div>
                    <div class="mb-1">
                        <label for="category" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product
                            category</label>
                        <input type="text" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Category" />
                    </div>
                    <div class="mb-1">
                        <label for="quantity" class="block mb-1 text-sm font-bold text-gray-900 text-light">Product
                            quantity</label>
                        <input type="number" id="quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Quantity" />
                    </div>
                    <div class="mb-1">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-bold text-gray-900 text-light">Status</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
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
