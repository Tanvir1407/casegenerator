<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGeneratorType extends CreateRecord
{
    protected static string $resource = GeneratorTypeResource::class;
}
