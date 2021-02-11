@extends('layouts.app')

@section('content')
        
            <div class="row mt-4">
                <div class="col"></div>
                <div class="col-sm-4 ">
                
                    <form action="{{ URL::to('readinglist/create') }}" method="POST">
                    @csrf
                        <div class="form-row justify-content-center">
                            <div class="col-auto">
                                <label for="searchInput">Search: </label>
                                <input type="text" name="searchInput" id="searchInput">
                            
                                <button type="submit" class="btn btn-primary btn-sm mb-1">Go</button>
                            </div>
                        </div>
                    </form>
                
                </div>
                <div class="col"></div>
            </div>

            <div class="row my-3">
                <div class="col"></div>
                <div class="justify-content-center text-success">
                    @if (!empty($search_term))
                        <strong>Showing results for "{{ $search_term}}" books</strong>
                    @else
                        <strong>Showing results for "New" books</strong>
                    @endif
                </div>
                <div class="col"></div>
            </div>
            
            
            <div class="row">
                <div class="col"></div>
                <div class="col form-group">
                
                    <div class="list-group">
                    
                    @foreach ($available_books as $available_book)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-primary">{{ $available_book->title }}</h5>
                            </div>
                            <p class="mb-1 text-muted">{{ $available_book->subtitle }}</p>
                            <div class="d-flex w-100 justify-content-between">
                                <small>ISBN: {{ $available_book->isbn13 }}</small>
                                <form action="{{ URL::to('readinglist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="isbn" value="{{  $available_book->isbn13 }}" />
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="col"></div>
            </div>
            
@endsection
