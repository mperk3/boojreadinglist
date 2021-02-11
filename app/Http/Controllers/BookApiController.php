<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BookApiController extends Controller
{
    public function getBookList($search_term='') :array {

        //instantiate the Guzzle client
        $client = new Client();
        if(empty($search_term)){
            $url = "https://api.itbook.store/1.0/new";
        } else{
            $url = "https://api.itbook.store/1.0/search/{$search_term}";
        }

        //make the request to the API using the Guzzle client
        try{
            $response = $client->request('GET',$url);
        } catch (ClientException $e){
            return false;
        }

        //parse the response, decoding the json into an array
        $body = json_decode($response->getBody());
        $books = $body->books;

        //sort the books by title
        $books = collect($books)->sortBy('title')->toArray();

        return $books;
    }

    public function getBookByISBN($isbn){
        if(empty($isbn)){
            return false;
        }

        //instantiate the Guzzle client
        $client = new Client();
        $url = "https://api.itbook.store/1.0/books/{$isbn}";

        //make the request to the API using the Guzzle client
        try{
            $response = $client->request('GET',$url);
        } catch (ClientException $e){
            return false;
        }
        

        //parse the response, decoding the json into an array
        $book = json_decode($response->getBody());

        return $book;
    }
}
