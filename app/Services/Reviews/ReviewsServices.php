<?php

namespace App\Services\Reviews;

use App\Models\Review;
use Illuminate\Http\Response;
use App\Contracts\Reviews\ReviewServiceContract;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Resources\Review\ReviewCollection;

class ReviewsServices implements ReviewServiceContract
{

    /**
     * create a review
     * 
     * @param array $data.
     * @return ReviewsResource
     */
    public function create($data): ReviewResource
    {
        return new ReviewResource(Review::create($data));
    }

    /**
     * update a review
     * 
     * @param Review $review.
     * @return ReviewsResource
     */
    public function update(Review $review, array $data): ReviewResource
    {
        $review->update($data);
        return new ReviewResource($review);
    }


    /**
     * get all reviews
     * 
     * @return ReviewCollection
     */

    public function index(): ReviewCollection
    {

        return new ReviewCollection(Review::all());
    }


    /**
     * get a review
     * @param Review $review
     * @return ReviewResource
     */

    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review);
    }



    /**
     * delete a review
     * 
     * @param Review $review.
     * @return Illuminate\Http\Response
     */

    public function delete(Review $review): Response
    {
        $review->delete();
        return response()->noContent();
    }
}
