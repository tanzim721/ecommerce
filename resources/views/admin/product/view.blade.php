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
                    <h1 style="color: white; font-size: 30px;" class="text-bold">Add Product</h1>
                </div>
                <div class="col">
                    <div class="div_deg d-inline">
                        <div class="form-group">
                            <input type="text" name="category" id="categoryInput" placeholder="Search" required class="form-control"
                                style="display: inline;" class="fa fa-search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                <a href="{{ route('admin.product.add') }}" style="color: white; text-decoration: none">Add Product</a>
                            </button>
                        </div>
                        @if ($errors->has('product'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('product') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @include('admin.product.list')
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
                    swal("Your Product is safe!");
                }
            });
        }
    </script>
    @include('admin.layouts.script')
  </body>
</html>
