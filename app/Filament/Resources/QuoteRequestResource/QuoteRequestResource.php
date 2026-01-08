<?php

namespace App\Filament\Resources\QuoteRequestResource;

use App\Models\QuoteRequest;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Infolist;

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
                        ->options([
                            'construction' => 'Construction',
                            'manufacturing' => 'Manufacturing',
                            'healthcare' => 'Healthcare',
                            'data-center' => 'Data Center',
                            'hospitality' => 'Hospitality',
                            'retail' => 'Retail',
                            'residential' => 'Residential',
                            'other' => 'Other',
                        ])
                        ->placeholder('Select an industry'),

                    Textarea::make('message')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull()
                        ->placeholder('Enter additional details'),
                ])
                ->columns(2),
        ])
        ->columns(1);
    }

    /* ===================== INFOLIST ===================== */
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Quote Request Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->weight(\Filament\Support\Enums\FontWeight::Bold),
                                TextEntry::make('email')
                                    ->icon('heroicon-m-envelope')
                                    ->copyable(),
                                TextEntry::make('phone')
                                    ->icon('heroicon-m-phone'),
                                
                                TextEntry::make('industry')
                                    ->formatStateUsing(fn (?string $state): string => $state ? ucwords(str_replace('-', ' ', $state)) : 'N/A')
                                    ->badge(),
                                TextEntry::make('created_at')
                                    ->label('Submitted At')
                                    ->dateTime(),
                            ]),
                        TextEntry::make('message')
                            ->label('Additional Details')
                            ->limit(20)
                            ->columnSpanFull()
                            ->prose()
                            ->markdown(),
                    ])
            ])
            ->columns(1);
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
                    ->sortable()
                    ->placeholder('N/A'),

                TextColumn::make('industry')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (?string $state): string => $state ? ucwords(str_replace('-', ' ', $state)) : 'N/A')
                    ->placeholder('N/A'),

                TextColumn::make('message')
                    ->label('Additional Details')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted At'),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // Bulk actions will be available
            ])
            ->defaultSort('created_at', 'desc');
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
