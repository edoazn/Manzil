<?php

namespace App\Filament\Resources\Houses\Pages;

use App\Filament\Resources\Houses\HouseResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateHouse extends CreateRecord
{
    protected static string $resource = HouseResource::class;

    protected Width|string|null $maxContentWidth = Width::Full;
}
