<!DOCTYPE html>
<html>
  <head>
    @include('admin.layouts.head')
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
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        @include('admin.layouts.content')

        @include('admin.layouts.footer')
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
