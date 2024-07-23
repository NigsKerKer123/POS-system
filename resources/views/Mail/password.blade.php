<!DOCTYPE html>
<html lang="en"">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Javavibe: Password</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" style="border-radius: 50%;">
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    
    <body>
        <p class="text-4xl font-black text-gray-900 dark:text-white">Here's your password: {{$password}}</p>
    </body>
</html>
