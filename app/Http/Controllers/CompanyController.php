<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\SiteSetting;
use Exception;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $data['keys'] = SiteSetting::$keys;
        $data['site_settings'] = SiteSetting::all();
        return view('company.create', $data);
    }

    public function store(CompanyRequest $request)
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
                    $site_setting->addMedia($request->file($key))->usingFilename(md5(Str::random(8) . time()) . '.' . explode('/', mime_content_type($request->file($key)))[1])->toMediaCollection();
                }
            }
            return back()->with('success', 'Company data has been saved');
        } catch (Exception $e) {
            return $this->$e->getMessage();
        }
    }
}
