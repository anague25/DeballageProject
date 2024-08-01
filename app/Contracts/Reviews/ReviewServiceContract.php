<?php

namespace App\Contracts\Reviews;

use App\Models\Product;
use App\Models\Review;
use App\Models\Shop;

interface ReviewServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Review $review
     */
    public function show(Review $review);


    public function getNumberOfReviewingUsersForProduct(Product $product);

    public function getNumberOfReviewingUsersForShop(Shop $shop);


    public function index();

    public function getReviews(int $reviewableId, string $reviewableType);

    /**
     * @param Review $review
     * @param array $data
     */
    public function update(Review $review, array $data);


    /**
     * @param Review $review
     */
    public function delete(Review $review);
}
