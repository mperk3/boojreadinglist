<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        
        
        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link href="https://bootswatch.com/4/yeti/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous"></script>
        
    </head>
    
    <body>
        <div class="container-fluid mt-4">
        
            <div class="row">
                <div class="col content-center">
                    <h1 class="display-4 text-center">My Reading List</h1>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-sm-4"><a href="/add_book_form" class="btn btn-primary btn-block"><i class="fas fa-book"></i> Add Book</a></div>
                <div class="col"></div>
            </div>
            <div class="row mt-4">
                <div class="col"></div>
                <div class="col-sm-8">
                    <table class="table table-sm table-hover" id="reading-list">
                        <thead>
                            <tr>
                            <th width=40% scope="col">Title</th>
                            <th width=40% scope="col">Authors</th>
                            <th width=20% scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($my_books as $my_book)
                                <tr class="book-row" data-bookId="">
                                    <td><a href="/detail/{{ $my_book->id }}">{{ $my_book->title }}</a></td>
                                    <td>{{ $my_book->authors }}</td>
                                    <td>
                                        @if ($loop->first)
                                            <button type="button" class="btn btn-primary disabled"><i class="fas fa-arrow-circle-up"></i></button>
                                        @else
                                            <button type="button" class="btn btn-primary move-up" data-id="{{ $my_book->id }}"><i class="fas fa-arrow-circle-up move-up" data-id="{{ $my_book->id }}"></i></button>
                                        @endif

                                        @if ($loop->last)
                                            <button type="button" class="btn btn-primary disabled"><i class="fas fa-arrow-circle-down"></i></button>
                                        @else
                                            <button type="button" class="btn btn-primary move-down" data-id="{{ $my_book->id }}"><i class="fas fa-arrow-circle-down move-down" data-id="{{ $my_book->id }}"></i></button>
                                        @endif

                                        <button type="button" class="btn btn-danger remove" data-bookId="{{ $my_book->id }}" title="Remove" ><i class="fas fa-minus-circle"></i></button>

                                    </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col"></div>
            </div>
        </div>
        <script lang="javascript">
            $(document).ready(function(){
                $('#reading-list').on('click', '.remove', function(e) {                
                    const el = $(this);
                    const book_id = el.attr('data-bookId');
                    if(typeof book_id !== number){
                        bootbox.alert('Unable to process your request.');
                        return;
                    }

                    bootbox.confirm('Are you sure you want to remove this book from your reading list?', function(result){
                        $.post(
                            '/remove_book', 
                            {id : book_id},
                            function(response){
                                const obj = JSON.parse(response);
                                console.log($obj);
                                $(".book_row[data-bookId=" + book_id + "]").remove();
                            }
                        );
                    });
                    
                
                });
            });
            
        </script>
    </body>
</html>
