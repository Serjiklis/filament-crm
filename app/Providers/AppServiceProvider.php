<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use App\Filament\Resources\UserResource;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Model::unguard();
        
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                        UserMenuItem::make()
                        ->label('Your Profile')
                        ->url(UserResource::getUrl('edit',['record'=>auth()->user()]))
                        ->icon('heroicon-s-user'),
                        UserMenuItem::make()
                        ->label('Manage Users')
                        ->url(UserResource::getUrl())
                        ->icon('heroicon-s-cog'),
                    // ...
            ]);
        });
    }

}
