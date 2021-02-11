@extends('layouts.app')

@section('content')
            <div class="row">
                <div class="col"></div>
                <div class="col-sm-4"><a href="{{ URL::to('readinglist/create') }}" class="btn btn-primary btn-block"><i class="fas fa-book mx-2"></i> Add a Book</a></div>
                <div class="col"></div>
            </div>
            <div class="row mt-4">
                <div class="col"></div>
                <div class="col-sm-8">
                    <table class="table table-sm" id="reading-list">
                        <thead>
                            <tr>
                            <th width=40% scope="col"><a href="{{ URL::to('readinglist/sort/title') }}">Title</a></th>
                            <th width=40% scope="col"><a href="{{ URL::to('readinglist/sort/authors') }}">Authors</a></th>
                            <th width=10% scope="col">Up/Down</th>
                            <th width=10% scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($my_books as $my_book)
                                <tr class="book-row" data-bookId="">
                                    <td><a href="{{ URL::to('readinglist/' . $my_book->id) }}">{{ $my_book->title }}</a></td>
                                    <td>{{ $my_book->authors }}</td>
                                    <td>
                                        <form method="POST" action="{{ URL::to('readinglist/'.$my_book->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            
                                            @if ($loop->first)
                                                <button type="button" class="btn btn-primary disabled" title="Move Up"><i class="fas fa-arrow-circle-up"></i></button>
                                            @else
                                                <button type="submit" name="action" value="move_up" class="btn btn-primary move-up" title="Move Up" data-id="{{ $my_book->id }}"><i class="fas fa-arrow-circle-up move-up" data-id="{{ $my_book->id }}"></i></button>
                                            @endif
                                        
                                            @if ($loop->last)
                                                <button type="button" class="btn btn-primary disabled" title="Move Down"><i class="fas fa-arrow-circle-down"></i></button>
                                            @else
                                                <button type="submit" name="action" value="move_down" class="btn btn-primary move-down" title="Move Down" data-id="{{ $my_book->id }}"><i class="fas fa-arrow-circle-down move-down" data-id="{{ $my_book->id }}"></i></button>
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ URL::to('readinglist/'.$my_book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger remove pull-left" title="Remove"><i class="fas fa-minus-circle"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="col"></div>
            </div>
        </div>
        
    
@endsection