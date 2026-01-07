<?php

namespace App\Filament\Resources;

use App\Models\Contact;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationLabel = 'Contact';
    
    protected static ?string $modelLabel = 'contact message';
    
    protected static ?string $pluralModelLabel = 'contact messages';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    /* ===================== INFOLIST (VIEW) ===================== */
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Contact Information')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextEntry::make('name')
                                    ->icon('heroicon-m-user')
                                    ->label('Name'),
                                
                                TextEntry::make('email')
                                    ->icon('heroicon-m-envelope')
                                    ->label('Email')
                                    ->copyable(),
                                
                                TextEntry::make('phone')
                                    ->icon('heroicon-m-phone')
                                    ->label('Phone')
                                    ->placeholder('N/A'),
                            ]),
                    ]),

                Section::make('Message Content')
                    ->schema([
                        TextEntry::make('message')
                            ->hiddenLabel()
                            ->prose() // Makes it look like an article/content
                            ->markdown(), // Assuming message might be plain text but markdown adds nice typography
                        
                        TextEntry::make('created_at')
                            ->label('Received At')
                            ->dateTime('F j, Y, g:i a')
                            ->badge()
                            ->color('gray')
                            ->alignLeft(),
                    ]),
            ]);
    }

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
                    ->limit(20)
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
                ViewAction::make()
                    ->extraAttributes(['class' => 'view-button']),
                DeleteAction::make(),
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

