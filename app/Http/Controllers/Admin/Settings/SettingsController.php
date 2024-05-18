<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Settings\SettingServiceContract;
use App\Http\Requests\Settings\SettingsUpdateRequest;

class SettingsController extends Controller
{
    private $settingsService;

    public function __construct(SettingServiceContract $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    // public function index()
    // {
    //     return $this->settingsService->index();
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     return  $this->settingsService->create($request->validated());
    // }

    /**
     * Display the specified setting.
     * 
     */
    public function show(Setting $setting)
    {
        return $this->settingsService->show($setting);
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(SettingsUpdateRequest $request, Setting $setting)
    {
        return $this->settingsService->update($setting, $request->validated());
    }

    /**
     * Remove the specified setting from storage.
     */
    public function destroy(Setting $setting)
    {
        return $this->settingsService->delete($setting);
    }
}
