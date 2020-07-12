<?php

namespace App\Services;

use Auth;
use App\Book;
use App\Author;
use App\Http\Traits\PhotoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;

class BookService {
    
    use PhotoTrait;

    public function storeBook(BookCreateRequest $request) {
        
        DB::beginTransaction();

        try {
            $book = new Book($request->validated());
            $book->picture = $this->savePhoto($request->image);
            $book->author()->associate(Author::find($request->author_id));
            $book->creator()->associate(Auth::user()->id);
            $book->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        DB::commit();
        return $book;
        
    }
    
    public function updateBook(BookUpdateRequest $request, $book) {
        
        DB::beginTransaction();

        try {
            $book->update($request->validated());
            $book->picture = $this->savePhoto($request->image);
            $book->author()->associate(Author::find($request->author_id));
            $book->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        DB::commit();
        return $book;
        
    }
    
}
