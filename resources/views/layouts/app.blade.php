<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Dev')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="container mt-5">
        @yield('content')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    Toastify({
                        text: "{{ $error }}",
                        duration: 5000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#FF0000"
                        },
                        close: true,
                        stopOnFocus: true
                    }).showToast();
                @endforeach
            @endif

            @if (session('success'))
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#28a745"
                    },
                    close: true,
                    stopOnFocus: true 
                }).showToast();
            @endif
        });

    </script>
    
    </div>
</body>
</html>
