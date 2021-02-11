@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col"></div>
        <div class="col-sm-6 text-center">
            <div class="card">
                <div class="card-header"><h4>Book Detail</h4></div>
                <div class="card-body">
                    <div class="row h-100">
                        <div class="col-sm-6">
                            <img src="{{ $book->image_url }}" class="img-fluid">
                        </div>
                        <div class="col-sm-6 text-left my-auto">
                            <span class='align-middle'> 
                                <p><strong>Title:</strong> {{ $book->title }}</h5></p>
                                <p><strong>Subtitle:</strong> {{ $book->subtitle}} </p>
                                <p><strong>Author(s):</strong> {{ $book->authors }}</p>
                                <p><strong>ISBN:</strong> {{ $book->isbn13}}</p>
                            </span>
                        </div>
                    </div>
                    <a href="{{ URL::to('readinglist') }}" class="btn btn-primary btn-block">Back to Reading List</a>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

    
@endsection