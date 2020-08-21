<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>Trang chủ</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('style')
</head>

<body id="@yield('classBody')">
    @yield('app')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js' )}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
      $(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
      })
    </script>
    @yield('script')
    <script>
      @if ($message = session('success'))
        toastr.success("{{ $message }}")
      @endif
      @if ($message = Session::get('error'))
        toastr.error("{{ $message }}")
      @endif
      @if ($message = Session::get('warning'))
        toastr.warning("{{ $message }}")
      @endif
      @if ($message = Session::get('info'))
        toastr.info("{{ $message }}")
      @endif
      @if ($errors->any())
        toastr.error("{{ $message }}")
      @endif
    </script>
</body>
</html>
