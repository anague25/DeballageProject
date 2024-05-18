<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Http\Response;
use App\Contracts\Settings\SettingServiceContract;
use App\Http\Resources\Settings\SettingsResource;
use App\Http\Resources\Settings\SettingsCollection;

class SettingsServices implements SettingServiceContract
{

    /**
     * create a setting
     * 
     * @param array $data.
     * @return SettingsResource.
     */
    public function create($data): SettingsResource
    {
        return new SettingsResource(Setting::create($data));
    }

    /**
     * update a setting
     * 
     * @param Setting setting.
     * @return SettingsResource.
     */
    public function update(Setting $setting, array $data): SettingsResource
    {
        $setting->update($data);
        return new SettingsResource($setting);
    }


    /**
     * get all settings
     * 
     * @return array.
     */

    public function index(): SettingsCollection
    {

        return new SettingsCollection(Setting::all());
    }


    /**
     * get a setting
     * @param Setting setting
     * @return SettingsResource.
     */

    public function show(Setting $setting): SettingsResource
    {
        return new SettingsResource($setting);
    }



    /**
     * delete an setting
     * 
     * @param Setting setting.
     * @return Illuminate\Http\Response
     */

    public function delete(Setting $setting): Response
    {
        $setting->delete();
        return response()->noContent();
    }
}
