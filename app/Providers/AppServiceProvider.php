<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Client;
use App\Models\Maintenance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User::class);
        $this->app->singleton(Client::class);
        $this->app->singleton(Maintenance::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // paginator
        Paginator::defaultView('vendor.pagination.default');
        // Paginator::defaultSimpleView('view-name');

        // Validator
        Validator::extend('no_ctrl_chars', 'App\Validators\CustomValidator@validateNoControlCharacters');
        Validator::extend('no_ctrl_chars_excluding_tab_lf', 'App\Validators\CustomValidator@validateNoControlCharactersExcludingTabLf');
        Validator::extend('alpha_custom', 'App\Validators\CustomValidator@validateAlphaCustom');
        Validator::extend('alpha_dash_custom', 'App\Validators\CustomValidator@validateAlphaDashCustom');
        Validator::extend('alpha_num_custom', 'App\Validators\CustomValidator@validateAlphaNumCustom');
        Validator::extend('alpha_num_symbol', 'App\Validators\CustomValidator@validateHalfAlphaNumSymbol');
        Validator::extend('zenkaku_kana', 'App\Validators\CustomValidator@validateZenkakuKana');
        Validator::extend('is_http', 'App\Validators\CustomValidator@validateIsHttp');
        Validator::extend('hiragana', 'App\Validators\CustomValidator@validateHiragana');
        Validator::extend('hiragana_with_space', 'App\Validators\CustomValidator@validateHiraganaWithSpace');
        Validator::extend('zenkaku_kana_with_space', 'App\Validators\CustomValidator@validateZenkakuKanaWithSpace');
    }
}
