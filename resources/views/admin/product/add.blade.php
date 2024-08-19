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
                <div class="container-fluid">
                    <form class="max-w-sm mx-auto">
                        @csrf
                        {{-- table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('price')->nullable();
            $table->string('category')->nullable();
            $table->string('quantity')->nullable();
            $table->string('status')->nullable(); --}}
                        <div class="mb-2">
                            <label for="title" class="block mb-2 text-sm font-bold text-gray-900 text-light">Product
                                title</label>
                            <input type="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Titles" required />
                        </div>
                        <div class="mb-2">
                            <label for="description"
                                class="block mb-2 text-sm font-bold text-gray-900 text-light">Product
                                description</label>
                            <input type="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Description" required />
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload file</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">

                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
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
