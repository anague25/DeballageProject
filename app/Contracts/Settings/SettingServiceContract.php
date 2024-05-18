<?php

namespace App\Contracts\Settings;

use App\Models\Setting;

interface SettingServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Setting $setting
     */
    public function show(Setting $setting);


    public function index();

    /**
     * @param Setting $setting
     * @param array $data
     */
    public function update(Setting $setting, array $data);


    /**
     * @param Setting $setting
     */
    public function delete(Setting $setting);
}
