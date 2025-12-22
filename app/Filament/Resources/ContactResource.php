<?php

namespace App\Filament\Resources;

use App\Models\Contact;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationLabel = 'Contact';
    
    protected static ?string $modelLabel = 'contact message';
    
    protected static ?string $pluralModelLabel = 'contact messages';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    /* ===================== FORM ===================== */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('phone')
                ->tel()
                ->nullable()
                ->maxLength(20),

            Textarea::make('message')
                ->required()
                ->columnSpanFull()
                ->rows(6),
        ]);
    }

    /* ===================== TABLE ===================== */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->sortable(),

                TextColumn::make('message')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                // Actions are handled in page classes
            ])
            ->bulkActions([
                // 
            ]);
    }

    /* ===================== PAGES ===================== */
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ContactResource\Pages\ListContacts::route('/'),
            'view'  => \App\Filament\Resources\ContactResource\Pages\ViewContact::route('/{record}'),
        ];
    }
}
