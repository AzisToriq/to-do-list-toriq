<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Set Carbon & lokal sistem ke Bahasa Indonesia
        Carbon::setLocale('id'); // Untuk Carbon: Senin, 31 Juli 2025
        setlocale(LC_TIME, 'id_ID.utf8'); // Untuk fungsi date/time biasa (strftime dll.)
    }
}
