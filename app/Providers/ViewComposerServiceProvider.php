<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\GoldRate;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['components.dashboard-topbar', 'components.admin-topbar'], function ($view) {
            $view->with('topbarRate', GoldRate::latest()->first());
        });
    }
}