<?php

namespace App\Services\Reviews;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Resources\Review\ReviewCollection;
use App\Contracts\Reviews\ReviewServiceContract;

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
        $user = Auth::user();
        // $existingFavorite = $user->favorites()
        //     ->where('favoritable_type', $data['favoritable_type'])
        //     ->where('favoritable_id', $data['favoritable_id'])
        //     ->first();

        // if ($existingFavorite) {

        //     return response()->json(['message' => 'This element already added on favorite'], 403);
        // }

        $review = $user->reviews()->create($data);
        return new ReviewResource($review);
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
     * Get reviews for a specific shop or product.
     *
     * @param int $reviewableId
     * @param string $reviewableType
     * @return \Illuminate\Support\Collection
     */
    public function getReviews(int $reviewableId, string $reviewableType)
    {
        // dd($reviewableId, $reviewableType);

        $reviews = Review::where('reviewable_id', $reviewableId)
            ->where('reviewable_type', $reviewableType)->with('user')->orderByDesc('created_at')
            ->get();

        return response()->json($reviews, 200);
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
     * Get the number of distinct users who have left a review for a product.
     *
     * @param Product $product
     * @return int
     */
    public function getNumberOfReviewingUsersForProduct(Product $product): int
    {
        return DB::table('reviews')
            ->where('reviewable_id', $product->id)
            ->where('reviewable_type', Product::class)
            ->distinct('user_id')
            ->count('user_id');
    }

    /**
     * Get the number of distinct users who have left a review for a shop.
     *
     * @param Shop $shop
     * @return int
     */
    public function getNumberOfReviewingUsersForShop(Shop $shop): int
    {
        return DB::table('reviews')
            ->where('reviewable_id', $shop->id)
            ->where('reviewable_type', Shop::class)
            ->distinct('user_id')
            ->count('user_id');
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
