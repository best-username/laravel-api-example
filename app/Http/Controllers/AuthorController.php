<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /** @api {get} {{host}}/api/authors
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success' => true, 'data' => AuthorResource::collection(Author::all())->paginate(10)]);
    }

    /** @api {get} {{host}}/api/author/1
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return response()->json(['success' => true, 'data' => new AuthorResource($author)]);
    }

}
