<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Filters\BorrowingFilter;
use App\Http\Resources\BorrowingsResource;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Resources\BorrowingsCollection;
use App\Http\Requests\UpdateBorrowingRequest;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }
}
