<!DOCTYPE html>
<html>
  <head>
    @include('admin.head')
    <style>
        input[type="text"] {
            width: 350px;
            height: 40px;
        }
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px;
        }

    </style>
  </head>
  <body>

    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 style="color: white;">Add Category</h2>
            <div class="div_deg">
                <form action="{{ route('category.add') }}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="category" id="">
                        <input type="submit" name="" id="" class="btn btn-primary" value="Add Category">
                    </div>
                </form>
                {{-- 01717938355 --}}
            </div>
            <div class="pt-3 sm:pt-5">
                <table class="table table-bordered table_deg">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <a href="{{ route('category.delete', $category->id) }}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>

        @include('admin.footer')
      </div>
    </div>

    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev){
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
                    swal("Your category is safe!");
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/graindashboard.js') }}"> </script>
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/charts-home.js') }}"></script>
    <script src="{{ asset('backend/js/front.js') }}"></script>
  </body>
</html>
