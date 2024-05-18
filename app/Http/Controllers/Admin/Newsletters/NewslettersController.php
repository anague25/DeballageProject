<?php

namespace App\Http\Controllers\Admin\Newsletters;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use App\Contracts\Newsletters\NewsletterServiceContract;
use App\Http\Requests\Newsletters\NewslettersStoreRequest;
use App\Http\Requests\Newsletters\NewslettersUpdateRequest;

class NewslettersController extends Controller
{
    private $newslettersService;

    public function __construct(NewsletterServiceContract $newslettersService)
    {
        $this->newslettersService = $newslettersService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
      return $this->newslettersService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewslettersStoreRequest $request)
    {
      return  $this->newslettersService->create($request->validated());
    }

    /**
     * Display the specified category.
     * 
     */
    public function show(Newsletter $newsletter)
    {
        return $this->newslettersService->show($newsletter);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(NewslettersUpdateRequest $request, Newsletter $newsletter)
    {
       return $this->newslettersService->update($newsletter,$request->validated());
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        return $this->newslettersService->delete($newsletter);
    }
}
