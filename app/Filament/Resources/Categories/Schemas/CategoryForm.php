<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Details')
                ->schema([
                    TextInput::make('name')
                    ->maxLength(255)
                    ->required(),


                    FileUpload::make('photo')
                    ->required()
                    ->image(),
                ])
            ]);
    }
}
