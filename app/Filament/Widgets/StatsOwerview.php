<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Contact;
use App\Models\User;
use App\Models\Organization;

class StatsOwerview extends BaseWidget {

    protected function getCards(): array {
        return [
            Card::make('Total User', User::query()->count()),
            Card::make('Total Organizations', Organization::query()->count()),
            Card::make('Total Contacts', Contact::query()->count())
                ->description('thats some big cheese numbers')
                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }

}
