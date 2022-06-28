<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models;
use App\Models\Account;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\UserResource\Pages\EditUser;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class UserResource extends Resource {

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form {
        return $form
                        ->schema([
                            FileUpload::make('photo_path')->avatar()->columnSpan('full'),
                            Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(25),
                            Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(25),
                            Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(50),
                            Forms\Components\DateTimePicker::make('email_verified_at'),
                            Forms\Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255)
                            ->dehydrateStateUsing(static fn(null|string $state): null|string => filled($state) ? Hash::make($state) : null)
                            ->required(static fn(Page $livewire): bool => $livewire instanceof CreateUser)
                            ->dehydrated(static fn(null|string $state): bool =>
                                    filled($state)
                            )->label(static fn(Page $livewire): string =>
                                    ($livewire instanceof EditUser) ? 'New Password' : 'Password'
                            ),
                            Forms\Components\Toggle::make('owner')
                            ->required(),
                            BelongsToSelect::make('account_id')
                            ->relationship('account', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
        ]);
    }

    public static function table(Table $table): Table {
        return $table
                        ->columns([
                            ImageColumn::make('photo_path')->rounded(),
                            Tables\Columns\TextColumn::make('first_name'),
                            Tables\Columns\TextColumn::make('last_name'),
                            Tables\Columns\TextColumn::make('email'),
                            Tables\Columns\TextColumn::make('email_verified_at')
                            ->dateTime(),
                            Tables\Columns\BooleanColumn::make('owner'),
                            Tables\Columns\TextColumn::make('created_at')
                            ->dateTime(),
                            Tables\Columns\TextColumn::make('updated_at')
                            ->dateTime(),
                            Tables\Columns\TextColumn::make('deleted_at')
                            ->dateTime(),
                        ])
                        ->filters([
                                //
                        ])
                        ->actions([
                            Tables\Actions\EditAction::make(),
                        ])
                        ->bulkActions([
                            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array {
        return [
                //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
