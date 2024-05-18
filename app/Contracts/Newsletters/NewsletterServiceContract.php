<?php

namespace App\Contracts\Newsletters;

use App\Models\Newsletter;

interface NewsletterServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Newsletter $newsletter
     */
    public function show(Newsletter $newsletter);


    public function index();

    /**
     * @param Newsletter $newsletter
     * @param array $data
     */
    public function update(Newsletter $newsletter, array $data);


    /**
     * @param Newsletter $newsletter
     */
    public function delete(Newsletter $newsletter);
}
