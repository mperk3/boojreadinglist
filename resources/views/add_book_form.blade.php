<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            /*
            body {
                font-family: 'Nunito';
            }
            */
        </style>
    </head>
    
    <body>
        <div class="container-fluid mt-4">
        <form>
            <div class="row">
                <div class="col"></div>
                <div class="col form-group">

                    <div class="list-group">
                    <form action="/readinglist/store" method="POST">
                    @foreach ($available_books as $available_book)
                        <a href="/add_book/{{ $available_book->isbn13 }}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $available_book->title }}</h5>
                            <!-- <small>{{ $available_book->subtitle }}</small> -->
                            </div>
                            <p class="mb-1">{{ $available_book->subtitle }}</p>
                            <small>ISBN: {{ $available_book->isbn13 }}</small>
                        </a>
                        @endforeach
                    </div>

                </div>
                <div class="col"></div>
            </div>
            </form>
        </div>
    </body>
</html>
