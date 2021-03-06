<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookResourceCollection;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        return new BookResourceCollection($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'author' => 'required',
        ]);
        $book = Book::create($request->all());
        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'author' => 'required',
        ]);
        $book = Book::find($id);
        $book->update($request->all());
        return (new BookResource($book))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete($id);
        return response()->json([
            'message' => "Book deleted success with id=$id"
        ]);
    }
}
