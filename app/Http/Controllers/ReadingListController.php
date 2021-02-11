<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\BookApiController;
use Illuminate\Support\Facades\Validator;

class ReadingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sort = 'position')
    {
        $my_books = Book::orderBy($sort, 'asc')->get();
        return view('readinglist.index', ['my_books' => $my_books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $books_api = new BookApiController;
        $search_term = '';
        
        if(!empty($request->searchInput)){
            $search_term = $request->searchInput;
        }
        $available_books = $books_api->getBookList($search_term);
        return view('readinglist.create', ['available_books' => $available_books, 'search_term' => $search_term]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $isbn = $request->isbn;
        //make sure a value was actually passed to the $isbn parameter
        if (empty($isbn)) {
            route('addBookForm', ['Unable to regtrieve the book']);
        }

        //request the book info from the API with the ISBN number
        $books_api = new BookApiController;
        $book = $books_api->getBookByISBN($isbn);

        //check to make sure a book was returned
        if (empty($book)) {
            route('addBookForm', ['error' => 'Unable to retrieve the book']);
        }

        //validate the data before we place it in the database
        $validated = Validator::make((array) $book, [
            'title'     => 'required|string',
            'subtital'  => 'nullable|string',
            'authors'    => 'required|string',
            'isbn13'    => 'required|unique:books|string',
            'image'     => 'required|url'
        ]);


        //retrieve the largest 'position' value of a book in the list. If list is empty, set to 1
        $max_position = Book::max('position');
        $position = $max_position ? ($max_position + 1) : 1;

        //store the book 
        $book_new = Book::create([
            'title'     => $book->title,
            'subtitle'  => $book->subtitle ?: '',
            'authors'    => $book->authors,
            'isbn13'    => $book->isbn13,
            'image_url' => $book->image,
            'position'  => $position
        ]);

        return redirect('/readinglist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('readinglist.show', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        
        $book = Book::find($id);

        if ($request->action == 'move_up') {
            //set the target 
            $book_target = Book::where('position', ($book->position) - 1)->first();
            $book_target->position = $book->position;
            $book_target->save();

            $book->position = ($book->position - 1);
            $book->save();
        }

        if ($request->action == 'move_down') {
            $book_target = Book::where('position', ($book->position) + 1)->first();
            $book_target->position = $book->position;
            $book_target->save();

            $book->position = ($book->position + 1);
            $book->save();
        }

        return redirect('/readinglist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        //reindex the positions
        $this->reindex();

        //send the user to the home view
        return redirect('/readinglist');
    }

    /**
     * Reindex the reading list to fix any gaps in the position values
     * 
     * @return void 
     */
    public function reindex()
    {
        $books = Book::orderBy('position', 'asc')->get();
        $index = 1;
        foreach ($books as $book) {
            $book->position = $index;
            $book->save();
            $index++;
        }
    }
}
