<?php

namespace App\Filament\Resources\OrganizatioResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Select;
use Squire\Models\Country;
use Filament\Pages\Actions;
use Filament\Tables\Actions\CreateAction;



class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('email')->unique(ignorable: fn (?Model $record): null|Model => $record)->email()->required(),
                TextInput::make('phone')->tel()->required(),
                TextInput::make('address')->required(),
                TextInput::make('city')->required(),
                TextInput::make('region')->required(),
                Select::make('country')
                    ->options(Country::query()
                    ->pluck('name', 'code_2'))
                    ->searchable()
                    ->required(),
                TextInput::make('postal_code')->required(),    
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('countryName.name'),
                
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                    $data['account_id'] = auth()->user()->account_id;
 
                    return $data;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
    
    
     
    
}
