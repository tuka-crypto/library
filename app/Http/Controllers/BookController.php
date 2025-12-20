<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ResponseHelper;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books=Book::with('category')->get();
        return ResponseHelper::success(BookResource::collection($books),'all books with there categories');
    }
    public function store(StoreBookRequest $request)
    {
        $book=Book::create($request->validated());
        if($request->hasFile('cover')){
            $file=$request->file('cover');
            $filename="$book->ISBN".$file->extension();
            Storage::putFileAs('book_images',$file,$filename,'public');
            $book->cover =$filename;
            $book->save();
        }
        return ResponseHelper::success(new BookResource($book),'added book successfully');
    }
    public function show(Book $book)
    {
        return ResponseHelper::success(new BookResource($book),'book details');
    }
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        if($request->hasFile('cover')){
            if($book->cover)
            Storage::disk('public')->delete("book_images/$book->cover");
            $file=$request->file('cover');
            $filename="$book->ISBN".$file->extension();
            Storage::putFileAs('book_images',$file,$filename,'public');
            $book->cover =$filename;
            $book->save();
        }
        return ResponseHelper::success(new BookResource($book),'updated book successfully');
    }
    public function destroy(Book $book)
    {
        $book->delete();
        return ResponseHelper::success('deleted book successfully');
    }
    public function search(Request $request){
        $request->validate([
            'title'=>'required|string|max:50'
        ]);
        $title=$request->title;
        $book=Book::where('title','like',"%$title%")->get();
        return ResponseHelper::success(new BookResource($book),'this is the book');
    }
    public function getByTitle(Request $request){
        $title=$request->title;
        $book=Book::where('title','like',"%$title%")->get();
        return ResponseHelper::success(new BookResource($book),'this is the book');
    }
    public function getByCategory(Request $request){
        $id=$request->category_id;
        $book=Book::where('category_id',$id)->get();
        return ResponseHelper::success(new BookResource($book),'book by category_id');
    }
}
