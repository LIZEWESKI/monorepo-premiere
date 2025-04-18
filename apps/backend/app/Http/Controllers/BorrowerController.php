<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use App\Filters\BorrowerFilter;
use App\Http\Resources\BorrowersResource;
use App\Http\Requests\StoreBorrowerRequest;
use App\Http\Resources\BorrowersCollection;
use App\Http\Requests\UpdateBorrowerRequest;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BorrowerFilter();
        $filterItems = $filter->transform($request);
        $includeBorrowings = $request->query("includeBorrowings");
        $borrowers = Borrower::where($filterItems);
        if($includeBorrowings) $borrowers->with("borrowings");
        return new BorrowersCollection($borrowers->paginate(5)->appends($request->query()));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowerRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrower $borrower, Request $request)
    {
        $includeBorrowings = $request->query("includeBorrowings");
        if($includeBorrowings) return new BorrowersResource($borrower->loadMissing("borrowings")); 
        return new BorrowersResource($borrower);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowerRequest $request, Borrower $borrower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrower $borrower)
    {
        //
    }
}
