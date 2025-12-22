<?php

namespace App\Filament\Resources\QuoteRequestResource;

use App\Models\QuoteRequest;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class QuoteRequestResource extends Resource
{
    protected static ?string $model = QuoteRequest::class;

    protected static ?string $navigationLabel = 'Request a Quote';
    
    protected static ?string $modelLabel = 'quote request';
    
    protected static ?string $pluralModelLabel = 'quote requests';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-plus';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'quote-requests';

    /* ===================== FORM ===================== */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Quote Request Details')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter client name'),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter email address'),

                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(20)
                        ->placeholder('Enter phone number'),

                    Select::make('industry')
                        ->required()
                        ->options([
                            'industry_one' => 'Industry One',
                            'industry_two' => 'Industry Two',
                            'industry_four' => 'Industry Four',
                        ])
                        ->placeholder('Select an industry'),

                    Textarea::make('message')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull()
                        ->placeholder('Enter additional details'),
                ])
                ->columns(2),
        ]);
    }

    /* ===================== TABLE ===================== */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('industry')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted At'),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                // Actions will be available
            ])
            ->bulkActions([
                // Bulk actions will be available
            ]);
    }

    /* ===================== PAGES ===================== */
    public static function getPages(): array
    {
        return [
            'index'  => \App\Filament\Resources\QuoteRequestResource\Pages\ListQuoteRequests::route('/'),
            'create' => \App\Filament\Resources\QuoteRequestResource\Pages\CreateQuoteRequest::route('/create'),
            'view'   => \App\Filament\Resources\QuoteRequestResource\Pages\ViewQuoteRequest::route('/{record}'),
            'edit'   => \App\Filament\Resources\QuoteRequestResource\Pages\EditQuoteRequest::route('/{record}/edit'),
        ];
    }
}
