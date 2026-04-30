<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\MenuItem;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share $site settings ke SEMUA view (frontend & admin)
        View::composer('*', function ($view) {
            try {
                $settings = Setting::all()->keyBy('key');
            } catch (\Throwable $e) {
                $settings = collect();
            }
            $view->with('site', $settings);

            try {
                $menuItems = MenuItem::with('children')
                    ->where('is_active', true)
                    ->whereNull('parent_id')
                    ->orderBy('urutan')
                    ->get();
            } catch (\Throwable $e) {
                $menuItems = collect();
            }
            $view->with('menuItems', $menuItems);
        });
    }
}
