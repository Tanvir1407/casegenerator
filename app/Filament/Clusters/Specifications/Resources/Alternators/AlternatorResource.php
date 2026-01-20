<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators;

use App\Filament\Clusters\Specifications\Resources\Alternators\Pages\CreateAlternator;
use App\Filament\Clusters\Specifications\Resources\Alternators\Pages\EditAlternator;
use App\Filament\Clusters\Specifications\Resources\Alternators\Pages\ListAlternators;
use App\Filament\Clusters\Specifications\Resources\Alternators\Schemas\AlternatorForm;
use App\Filament\Clusters\Specifications\Resources\Alternators\Tables\AlternatorsTable;
use App\Filament\Clusters\Specifications\SpecificationsCluster;
use App\Models\Alternator;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlternatorResource extends Resource
{
    protected static ?string $model = Alternator::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SpecificationsCluster::class;

    protected static ?string $recordTitleAttribute = 'model';

    public static function form(Schema $schema): Schema
    {
        return AlternatorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlternatorsTable::configure($table);
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
            'index' => ListAlternators::route('/'),
            'create' => CreateAlternator::route('/create'),
            'edit' => EditAlternator::route('/{record}/edit'),
        ];
    }
}
