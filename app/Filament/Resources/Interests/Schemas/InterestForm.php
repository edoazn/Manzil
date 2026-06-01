<?php

namespace App\Filament\Resources\Interests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InterestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                        Select::make('house_id')
                            ->relationship('house', 'name')
                            ->preload()
                            ->placeholder('Pilih rumah')
                            ->required(),

                        Select::make('bank_id')
                            ->relationship('bank', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih bank')
                            ->required(),

                        TextInput::make('interest')
                            ->required()
                            ->numeric()
                            ->suffix('%'),

                        TextInput::make('duration')
                            ->required()
                            ->numeric()
                            ->suffix('Years')
            ]);
    }
}
