<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Contracts\Reviews\ReviewServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Review;

class ReviewsController extends Controller
{
    private $reviewsService;

    public function __construct(ReviewServiceContract $reviewsService)
    {
        $this->reviewsService = $reviewsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->reviewsService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewStoreRequest $request)
    {
        return  $this->reviewsService->create($request->validated());
    }

    /**
     * Display the specified review.
     * 
     */
    public function show(Review $review)
    {
        return $this->reviewsService->show($review);
    }

    /**
     * Update the specified review in storage.
     */
    public function update(ReviewUpdateRequest $request, Review $review)
    {
        return $this->reviewsService->update($review, $request->validated());
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        return $this->reviewsService->delete($review);
    }
}
