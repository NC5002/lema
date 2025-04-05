<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #F5F1ED; /* Beige claro */
            font-family: 'Nunito', sans-serif;
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F5F1ED;
        }

        .auth-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo img {
            width: 80px;
            height: auto;
        }

        .btn-custom {
            background-color: #6A994E;
            color: white;
            padding: 0.5rem 1rem;
            font-weight: bold;
            border-radius: 0.375rem;
        }

        .btn-custom:hover {
            background-color: #58833f;
        }

        .text-link {
            color: #7B2C32;
        }

        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container pt-4">
        <div class="auth-card animate__animated animate__fadeIn">
            @if (isset($logo))
                <div class="logo">
                    {{ $logo }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>
</body>
</html>
