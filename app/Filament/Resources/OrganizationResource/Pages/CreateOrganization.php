<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array 
    { 
        
        return array_merge(
                $data,
                ['account_id' => auth()->user()->account_id]
        );
     
    }
     
}   
