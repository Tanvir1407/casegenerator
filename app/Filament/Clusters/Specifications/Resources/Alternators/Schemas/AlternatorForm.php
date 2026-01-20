<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlternatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('type'),
            ]);
    }
}
