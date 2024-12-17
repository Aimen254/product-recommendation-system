<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = getActiveAccount();
        $setting = $account->settings;
        return view('settings.index', compact('setting'));
    }

    public function save(SettingRequest $request)
    {
        try {
            $validated = $request->validated();
            $account = getActiveAccount();
            $setting = Setting::updateOrCreate([
                'account_id' => $account->id,
            ], [
                'company_name' => $validated['company_name'],
                'custom_domain' => $validated['custom_domain'],
                'status' => $request->has('domain_status') ? 'active' : 'inactive',
            ]);
            if ($request->has('logo')) {
                $logo = $request->file('logo');
                $setting->update(['logo' => time() . $logo->getClientOriginalName()]);
                $logo->storeAs('public/images', time() . $logo->getClientOriginalName());
            }

            if ($request->has('favicon')) {
                $favicon = $request->file('favicon');
                $setting->update(['favicon' => time() . $favicon->getClientOriginalName()]);
                $favicon->storeAs('public/images', time() . $favicon->getClientOriginalName());
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Account settings updated successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getDomainInfo()
    {
        try {
            $account = getActiveAccount();
            $setting = $account->settings;
            if ($setting->custom_domain) {
                return response()->json([
                    'domain' => 'Log in to your domain administration panel and find DNS records management panel for the domain: ' . $setting->custom_domain,
                ]);
            } else {
                return response()->json([
                    'domain' => 'Log in to your domain administration panel and find DNS records management panel for the domain: Unknown',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
