<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Services\SettingsService;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Str; 
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
            return view('admin.setting.packages.add-package');
        } else if ($request->key != '0') {
            // Fetch the package data from the 'packages' table
            $package = Package::find($request->key);
    
            // Check if package exists
            if ($package) {
                // If package found, pass it to the view
                return view('admin.setting.packages.edit-package', compact('package'));
            } else {
                abort(404); // This will return a 404 Not Found error page
            }
        }   
    }

    


    public function addnewPackage(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules for other fields if needed
        ]);
    
        // Create a new package instance
        $package = new Package();
        $package->name = $request->name;
        $package->slug = Str::slug($request->name); // Generate a slug from the name
        $package->customer_limit = $request->customer_limit ?? -1;
        $package->product_limit = $request->product_limit ?? -1;
        $package->subscription_limit = $request->subscription_limit ?? -1;
        $package->icon_id = $request->icon_id ?? null;
        $package->others = $request->others ?? null;
        $package->monthly_price = $request->monthly_price ?? 0.00;
        $package->yearly_price = $request->yearly_price ?? 0.00;
        $package->status = $request->status ?? 0;
        $package->is_default = $request->is_default ?? 0;
        $package->is_trail = $request->is_trail ?? 0;
    
        // Save the package to the database
        $package->save();
    
        // Redirect back with a success message
        return $this->success([], getMessage(UPDATED_SUCCESSFULLY)); 
   }
    
   
   public function editPackage(Request $request, $id) {
    $package = Package::find($id);

    if (!$package) {
        abort(404); // Package not found
    }

    // Update the package fields with the new values from the form
    $package->name = $request->input('name');
    $package->slug = Str::slug($request->input('name')); // Generate a slug from the name
    $package->customer_limit = $request->input('customer_limit');
    $package->product_limit = $request->input('product_limit');
    $package->subscription_limit = $request->input('subscription_limit');
    $package->icon_id = $request->input('icon_id');
    $package->others = $request->input('others');
    $package->monthly_price = $request->input('monthly_price');
    $package->yearly_price = $request->input('yearly_price');
    $package->status = $request->input('status');
    $package->is_default = $request->input('is_default');
    $package->is_trail = $request->input('is_trail');
    // Save the updated package
    $package->save();
    return $this->success([], getMessage(UPDATED_SUCCESSFULLY)); 

  }


    public function deletePackage($id)
    {
   
    // Find the package by ID
    $package = Package::find($id);

    // Check if the package exists
    if (!$package) {
        return response()->json(['error' => 'Package not found.'], 404);
    }

    // Permanently delete the package
    $package->forceDelete();

    // Return a success response
    return $this->success([], getMessage(UPDATED_SUCCESSFULLY)); 
}
  
}