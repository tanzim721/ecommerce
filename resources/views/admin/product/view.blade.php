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
                                style="display: inline; background-image: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'20\' height=\'20\'><path d=\'M7.14 14.77l-3.88-3.88a6 6 0 1 0-8.36 8.36l4.25 4.25 8.36-8.36a6 6 0 1 0-8.36-8.36l-3.13 3.13h.01zm-1.59-1.59a4 4 0 1 1 5.66 0L14.83 9.45 10.24 5.77a4 4 0 1 1 5.66 5.66l-3.13 3.13h.01z\'/></svg>'); background-repeat: no-repeat; background-position: 1% 50%; background-size: 20px 20px; padding-left: 30px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                <a href="{{ route('product.add') }}" style="color: white; text-decoration: none">Add Product</a>
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
            {{-- @include('admin.category.list') --}}
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
