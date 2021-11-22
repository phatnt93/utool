<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /** 
     * The path to the current lang files. 
     * 
     * @var string 
     */ 
    protected $langPath; 

    /** 
     * Create a new service provider instance. 
     * 
     * @return void 
     */ 
    public function __construct() 
    { 
        $this->langPath = resource_path('lang/' . App::getLocale());
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('translation', collect(File::allFiles($this->langPath))->flatMap(function ($file) {
            return [
                ($translation = $file->getBasename('.php')) => trans($translation),
            ];
        })->toJson());
    }
}
