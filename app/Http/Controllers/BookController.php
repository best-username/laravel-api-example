<?php

namespace App\Http\Controllers;

use Auth;
use App\Book;
use App\Author;
use Illuminate\Http\Request;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Services\BookService;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /** @api {get} {{host}}/api/books
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success' => true, 'data' => BookResource::collection(Book::all())->paginate(10)]);
    }

    /** @api {post} {{host}}/api/book
     * Store a newly created resource in storage.
     */
    public function store(BookCreateRequest $request)
    {
        $book = (new BookService())->storeBook($request);
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /** @api {get} {{host}}/api/book/1
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /** @api {put} {{host}}/api/book/58
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->authorize('update', $book);
        $book = (new BookService())->updateBook($request, $book);
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /** @api {destroy} {{host}}/api/book/58
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        return response()->json(['success' => $book->delete()]);
    }
    
    /** @api {destroy} {{host}}/api/books/mine
     * Remove the specified resource from storage.
     */
    public function getByUser()
    {
        $books = Auth::user()->books;
        return response()->json(['success' => true, 'data' => BookResource::collection($books)]);
    }
    
    /** @api {destroy} {{host}}/api/author/{author}/book/
     * Remove the specified resource from storage.
     */
    public function getByAuthor(Author $author)
    {
        $books = $author->books;
        return response()->json(['success' => true, 'data' => BookResource::collection($books)]);
    }
    
}
