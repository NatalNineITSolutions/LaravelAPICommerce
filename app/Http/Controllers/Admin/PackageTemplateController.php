<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SettingsService;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use App\Traits\ResponseTrait;
use Exception;

class PackageTemplateController extends Controller
{
    use ResponseTrait;

    public $settingsService;

    public function __construct()
    {
        $this->settingsService = new SettingsService();
    }

    public function packageTemplate()
    {
        $data['title'] = __("All Packages");
        $data['showManageApplicationSetting'] = 'active';
        $data['activeConfigurationSetting'] = 'active-color-one';
        return view('admin.setting.packages.packages')->with($data);
    }


    public function addPackage(Request $request)
    {
        if ($request->key == '0') {
            return view('admin.setting.general_settings.configuration.form.email_configuration');
        } else if ($request->key == '1') {
            return view('admin.setting.packages.edit-package');
        }
    }
    
}