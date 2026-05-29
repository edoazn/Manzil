<?php

namespace App\Filament\Resources\Houses\Schemas;

use App\Models\Facility;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->description('Informasi utama rumah')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->maxLength(255)
                            ->required(),

                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),

                        Select::make('certificate')
                            ->label('Sertifikat')
                            ->options([
                                'SHM' => 'SHM',
                                'SHGB' => 'SHGB',
                                'Pacthes' => 'Pacthes',
                            ])
                            ->required(),

                        FileUpload::make('thumbnail')
                            ->image()
                            ->required(),
                    ]),

                Section::make('Photos')
                    ->description('Foto-foto rumah')
                    ->schema([
                        FileUpload::make('photos')
                            ->hiddenLabel()
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('houses/photos')
                            ->reorderable()
                            ->panelLayout('grid')
                            ->dehydrated(false)
                            ->saveRelationshipsUsing(function ($record, $state) {
                                $record->photos()->delete();
                                foreach ((array) $state as $path) {
                                    $record->photos()->create(['photo' => $path]);
                                }
                            })
                            ->loadStateFromRelationshipsUsing(function ($component, $record) {
                                $component->state(
                                    $record?->photos?->pluck('photo')->all() ?? []
                                );
                            })
                            ->columnSpanFull(),
                    ]),

                Select::make('facilities')
                    ->label('Fasilitas')
                    ->multiple()
                    ->relationship('facilities', 'name')
                    ->preload()
                    ->searchable(),

                Section::make('Additional')
                    ->description('Detail tambahan tentang rumah')
                    ->columns(2)
                    ->schema([
                        Textarea::make('about')
                            ->label('Tentang')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('city_id')
                            ->label('Kota')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Fieldset::make('Spesifikasi')
                            ->columnSpanFull()
                            ->columns(3)
                            ->schema([
                                TextInput::make('electric')
                                    ->label('Listrik')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Watt'),

                                TextInput::make('land_area')
                                    ->label('Luas Tanah')
                                    ->required()
                                    ->numeric()
                                    ->suffix('m²'),

                                TextInput::make('building_area')
                                    ->label('Luas Bangunan')
                                    ->required()
                                    ->numeric()
                                    ->suffix('m²'),

                                TextInput::make('bedroom')
                                    ->label('Kamar Tidur')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Unit'),

                                TextInput::make('bathroom')
                                    ->label('Kamar Mandi')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Unit'),
                            ]),
                    ]),
            ]);
    }
}
