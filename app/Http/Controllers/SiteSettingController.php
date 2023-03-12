<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSetting\SiteSettingRequest;
use App\Models\SiteSetting;
use Exception;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    public function index()
    {
        $data['keys'] = SiteSetting::$keys;
        $data['site_settings'] = SiteSetting::all();
        return view('site-setting.index', $data);
    }

    public function store(SiteSettingRequest $request)
    {
        try {
            foreach(SiteSetting::$keys as $key => $data) {
                $value = $data["type"] == "image" ? $request->file($key) : $request->get($key);
                if (!$value) {
                    continue;
                }
                $site_setting = SiteSetting::updateOrCreate([
                    "key" => $key,
                ], [
                    "value" => $data["type"] == "text" ? $value : null,
                    "type" => $data["type"]
                ]);
                if ($data["type"] == "image") {
                    $site_setting->clearMediaCollection();
                    $site_setting->addMedia($request->file($key))->usingFilename(md5(Str::random(8) . time()) . '.' . $request->file($key)->getClientOriginalExtension())->toMediaCollection();
                }
            }
            return back()->with('success', 'Company data has been saved');
        } catch (Exception $e) {
            return $this->$e->getMessage();
        }
    }
}
