<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Wish;
use App\Present;

use TCG\Voyager\Events\FormFieldsRegistered;
use TCG\Voyager\Facades\Voyager as VoyagerFacade;
use TCG\Voyager\FormFields\After\DescriptionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));

        //update wish status
        Wish::saved(function(Wish $wish) {
            $wish->updateState();
        });

        Wish::updated(function($wish) {
            $wish->updateState();
        });

        Present::created(function($present) {
            $present->wish->updateState();
        });

        Present::updated(function($present) {
            $present->wish->updateState();
        });

        Present::deleted(function($present) {
            $present->wish->updateState();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFormFields();
    }

    protected function registerFormFields()
    {
        $formFields = [
            'open_street_map'
        ];

        foreach ($formFields as $formField) {
            $class = studly_case("{$formField}_handler");

            VoyagerFacade::addFormField("App\\FormFields\\{$class}");
        }

        VoyagerFacade::addAfterFormField(DescriptionHandler::class);

        event(new FormFieldsRegistered($formFields));
    }
}
