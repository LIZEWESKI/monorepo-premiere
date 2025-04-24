<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Filters\BookFilter;
use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BooksCollection;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\BulkStoreBookRequest;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BookFilter();
        $filterItems = $filter->transform($request); // [["column","operator","value"],...]
        $includeBorrowings = $request->query("includeBorrowings");
        $books = Book::where($filterItems);
        if($includeBorrowings) {
            $books->with("borrowings");
        }
        return new BooksCollection($books->paginate(5)->appends($request->query()));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        return new BooksResource(Book::create($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bulkStore(BulkStoreBookRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr,$key) {
            return Arr::except($arr,["publishedYear"]);
        });
        Book::insert($bulk->toArray());
        // return new BooksResource(Book::create($request->all()));
    }



    /**
     * Display the specified resource.
     */
    public function show(Book $book, Request $request)
    {
        $includeBorrowings = $request->query("includeBorrowings");
        if($includeBorrowings) return new BooksResource($book->loadMissing("borrowings"));
        return new BooksResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        return $book->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }
}
