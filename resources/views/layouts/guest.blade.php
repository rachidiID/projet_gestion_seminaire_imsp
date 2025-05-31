<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestion Séminaire IMSP</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sky-blue': {
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="page-container">
        {{ $slot ?? $content ?? '' }}
        <div class="text-center mb-8">
            <a href="/" class="flex items-center justify-center">
                <i class="fas fa-microphone-alt text-sky-blue-500 text-3xl mr-3"></i>
                <h1 class="text-3xl font-bold text-sky-blue-600">
                    Gestion Séminaire IMSP
                </h1>
            </a>
        </div>

        {{ $slot }}
    </div>
</body>
</html>