<?php

namespace App\Filament\Resources\Cities\Pages;

use App\Filament\Resources\Cities\CityResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;
    protected Width|string|null $maxContentWidth = Width::Full;
}
