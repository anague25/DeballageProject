<?php

namespace App\Contracts\Reviews;

use App\Models\Review;

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


    public function index();

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
