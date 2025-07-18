<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
	<link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">

    <script defer src="{{ asset('admin_asset/js/app.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('datatables/datatables.css') }}">
    <script defer src="{{ asset('datatables/datatables.js') }}"></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>
<body>
    <div class="wrapper">

        {{-- sidebar --}}
        @include('layouts.includes.sidebar')

        {{-- main --}}
        <div class="main">

            {{-- main/navbar --}}
            @include('layouts.includes.navbar')


            {{-- main/panel --}}
            <main class="content">
				<div class="container-fluid p-0">
                    {{ $slot }}
                </div>
            </main>

            {{-- main/footer --}}
            @include('layouts.includes.footer')

        </div>
        {{-- main-panel/ --}}

    </div>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

</body>
</html>
