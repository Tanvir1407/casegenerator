<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\CreateGeneratorType;
use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\EditGeneratorType;
use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\ListGeneratorTypes;
use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Schemas\GeneratorTypeForm;
use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Tables\GeneratorTypesTable;
use App\Filament\Clusters\Specifications\SpecificationsCluster;
use App\Models\GeneratorType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GeneratorTypeResource extends Resource
{
    protected static ?string $model = GeneratorType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SpecificationsCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GeneratorTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GeneratorTypesTable::configure($table);
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
            'index' => ListGeneratorTypes::route('/'),
            'create' => CreateGeneratorType::route('/create'),
            'edit' => EditGeneratorType::route('/{record}/edit'),
        ];
    }
}
