<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use App\Exceptions\Handler;
use App\Interfaces\EventInterface;
use App\Interfaces\TicketInterface;
use App\Interfaces\UserInterface;
use App\Repositories\EventRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandlerContract::class, Handler::class);
        $this->app->bind(EventInterface::class, EventRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(TicketInterface::class, TicketRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
