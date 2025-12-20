<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use ResponseHelper;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors=Author::withcount('books')->get();
        return ResponseHelper::success($authors,'all authors with their book counts');
    }
    public function store(StoreAuthorRequest $request)
    {
        $author=Author::create($request->validated());
        return ResponseHelper::success($author,'added author successfully');
    }
    public function show(Author $author)
    {
        return ResponseHelper::success($author,'author details');
    }
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return ResponseHelper::success($author,'updated author successfully');
    }
    public function destroy(Author $author)
    {
        $author->delete();
        return ResponseHelper::success('deleted  author successfully');
    }
}
