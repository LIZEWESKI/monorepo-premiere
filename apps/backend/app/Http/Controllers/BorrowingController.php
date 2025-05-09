<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Filters\BorrowingFilter;
use App\Http\Resources\BorrowingsResource;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Resources\BorrowingsCollection;
use App\Http\Requests\UpdateBorrowingRequest;
use App\Http\Requests\BulkStoreBorrowingRequest;
use Illuminate\Support\Arr;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BorrowingFilter();
        $filterItems = $filter->transform($request);
        $borrowings = Borrowing::where($filterItems);
        return new BorrowingsCollection($borrowings->paginate(5)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowingRequest $request)
    {
        new BorrowingsResource(Borrowing::create($request->all()));
    }
    public function bulkstore(BulkStoreBorrowingRequest $request)
    {
        // After getting all the data from the validated request, we exclude unwanted columns
        $bulk = collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,["bookId","borrowerId","borrowDate","returnDate"]);
        });
        // we bulk insert rows after converting the collection into an array
        Borrowing::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        return new BorrowingsResource($borrowing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowingRequest $request, Borrowing $borrowing)
    {
        return $borrowing->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }
}
