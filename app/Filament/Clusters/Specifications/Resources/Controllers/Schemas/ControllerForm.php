<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ControllerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->required(),
                TextInput::make('type')
                    ->required(),
            ]);
    }
}
