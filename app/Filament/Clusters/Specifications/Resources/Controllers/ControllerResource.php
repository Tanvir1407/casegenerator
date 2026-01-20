<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers;

use App\Filament\Clusters\Specifications\Resources\Controllers\Pages\CreateController;
use App\Filament\Clusters\Specifications\Resources\Controllers\Pages\EditController;
use App\Filament\Clusters\Specifications\Resources\Controllers\Pages\ListControllers;
use App\Filament\Clusters\Specifications\Resources\Controllers\Schemas\ControllerForm;
use App\Filament\Clusters\Specifications\Resources\Controllers\Tables\ControllersTable;
use App\Filament\Clusters\Specifications\SpecificationsCluster;
use App\Models\Controller;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ControllerResource extends Resource
{
    protected static ?string $model = Controller::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SpecificationsCluster::class;

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Schema $schema): Schema
    {
        return ControllerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ControllersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListControllers::route('/'),
            'create' => CreateController::route('/create'),
            'edit' => EditController::route('/{record}/edit'),
        ];
    }
}
