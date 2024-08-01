<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Reviews\ReviewServiceContract;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;

class ReviewsController extends Controller
{
    private $reviewsService;

    public function __construct(ReviewServiceContract $reviewsService)
    {
        $this->reviewsService = $reviewsService;
        // Appliquer le middleware auth:sanctum uniquement sur les méthodes store, update et destroy
        $this->middleware('auth:sanctum')->only(['store']);
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->reviewsService->index();
    }

    public function getReviews(Request $request)
    {
        $reviewableId = $request->query('reviewable_id');
        $reviewableType = $request->query('reviewable_type');
        return $this->reviewsService->getReviews($reviewableId, $reviewableType);
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
     * Get the number of distinct users who have left a review for a product.
     */
    public function getNumberOfReviewingUsersForProduct(Product $product)
    {
        return $this->reviewsService->getNumberOfReviewingUsersForProduct($product);
    }

    /**
     * Get the number of distinct users who have left a review for a shop.
     */
    public function getNumberOfReviewingUsersForShop(Shop $shop)
    {
        return $this->reviewsService->getNumberOfReviewingUsersForShop($shop);
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
