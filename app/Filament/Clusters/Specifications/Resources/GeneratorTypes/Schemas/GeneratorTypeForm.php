<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GeneratorTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
