<?php

namespace App\Services\Newsletters;

use App\Models\Newsletter;
use Illuminate\Http\Response;
use App\Contracts\Newsletters\NewsletterServiceContract;
use App\Http\Resources\Newsletters\NewslettersResource;
use App\Http\Resources\Newsletters\NewslettersCollection;

class NewslettersServices implements NewsletterServiceContract
{

    /**
     * create a Newsletter
     * 
     * @param array $data.
     * @return NewslettersResource
     */
    public function create($data): NewslettersResource
    {
        return new NewslettersResource(Newsletter::create($data));
    }

    /**
     * update a Newsletter
     * 
     * @param Newsletter $newsletter.
     * @return NewslettersResource.
     */
    public function update(Newsletter $newsletter, array $data): NewslettersResource
    {
        $newsletter->update($data);
        return new NewslettersResource($newsletter);
    }


    /**
     * get all Newsletters
     * 
     * @return array.
     */

    public function index(): NewslettersCollection
    {

        return new NewslettersCollection(Newsletter::all());
    }


    /**
     * get a Newsletter
     * @param Newsletter $newsletter
     * @return NewslettersResource.
     */

    public function show(Newsletter $newsletter): NewslettersResource
    {
        return new NewslettersResource($newsletter);
    }



    /**
     * delete a Newsletter
     * 
     * @param Newsletter $newsletter.
     * @return Illuminate\Http\Response.
     */

    public function delete(Newsletter $newsletter): Response
    {
        $newsletter->delete();

        return response()->noContent();
    }
}
