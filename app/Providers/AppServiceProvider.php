<?php

namespace App\Providers;

use App\Models\Lesson;
use App\Models\Ticket;
use App\Observers\LessonsObserver;
use App\Observers\TicketObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Ticket::observe(TicketObserver::class);
        Lesson::observe(LessonsObserver::class);
    }
}
