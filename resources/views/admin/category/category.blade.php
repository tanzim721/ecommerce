<!DOCTYPE html>
<html>
  <head>
    @include('admin.layouts.head')
    <style>
        input[type="text"] {
            width: 350px;
            height: 40px;
        }
        .div_deg{
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
            <div class="row py-2">
                <div class="col">
                    <h2 style="color: white;">Add Category</h2>
                </div>
                <div class="col">
                    <div class="div_deg d-inline">
                        <form action="{{ route('category.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="category" id="categoryInput" placeholder="Category Name" required class="form-control" style="display: inline;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Add Category
                                </button>
                            </div>
                        </form>
                        @if ($errors->has('category'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @include('admin.category.list')
          </div>
        </div>

        @include('admin.layouts.footer')
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
