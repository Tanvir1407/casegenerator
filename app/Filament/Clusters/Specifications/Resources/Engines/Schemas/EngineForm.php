<?php

namespace App\Filament\Clusters\Specifications\Resources\Engines\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EngineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model')
                    ->required(),
            ]);
    }
}
