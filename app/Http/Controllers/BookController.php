<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookResourceCollection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return new BookResourceCollection($books);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        $criteria = Book::select('*')
            ->where('title', 'LIKE', "%" . $keyword . "%")
            ->orderBy('views', 'DESC')
            ->get();
        return new BookResourceCollection($criteria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    public function slug($slug)
    {
        $criteria = Book::where('slug', $slug)->first();
        return new BookResource($criteria);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BookResource(Book::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete($id);
        return response()->json([
            'message' => "Book deleted success with id=$id"
        ]);
    }
}
