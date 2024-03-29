<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Events\QueryExecuted;

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
        $this->bootLogQuery();
        $this->bootCustomValidator();
    }

    protected function bootLogQuery()
    {
        if ($this->app->environment('local')) {
            Event::listen(QueryExecuted::class, function ($query) {
                $bindings = collect($query->bindings)->map(function ($param) {
                    if (is_numeric($param)) {
                        return $param;
                    } else {
                        return "'$param'";
                    }
                });
                $this->app->log->debug(Str::replaceArray('?', $bindings->toArray(), $query->sql));
            });
        }
    }

    protected function bootCustomValidator()
    {
         
    }
}
