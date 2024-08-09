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
                <form action="{{ route('add.category') }}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="category" id="">
                        <input type="submit" name="" id="" class="btn btn-primary" value="Add Category">
                    </div>
                </form>
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
                                <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger">Delete</a>
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
