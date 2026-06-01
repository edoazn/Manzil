<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->password()
                    ->helperText('Min 8 karakter.')
                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->revealable()
                    ->minLength(8)
                    ->maxLength(255),

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->placeholder('Pilih peran')
                    ->required(),

                FileUpload::make('photo')
                    ->image()
                    ->maxSize(1024)
                    ->helperText('Unggah foto profil (maks 1MB).'),

            ]);
    }
}
