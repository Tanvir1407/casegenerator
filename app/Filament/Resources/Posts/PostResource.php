<?php

namespace App\Filament\Resources\Posts;

use App\Models\Post;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use App\Filament\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Blog';
    
    protected static ?string $modelLabel = 'blog post';
    
    protected static ?string $pluralModelLabel = 'blog posts';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    /* ===================== FORM ===================== */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->unique('posts', 'title', ignoreRecord: true)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, $set) => 
                    $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique('posts', 'slug', ignoreRecord: true),

            FileUpload::make('featured_image')
                ->label('Featured Image')
                ->image()
                ->disk('public')
                ->directory('posts/featured')
                ->visibility('public')
                ->columnSpanFull(),

            RichEditor::make('body')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('blog-content')
                ->fileAttachmentsVisibility('public'),


        ]);
    }

    /* ===================== TABLE ===================== */
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Post $record) =>
                        Str::limit($record->slug, 30)
                    ),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ]);
    }

    /* ===================== PAGES ===================== */
    public static function getPages(): array
    {
        return [
            'index'  => \App\Filament\Resources\Posts\Pages\ListPosts::route('/'),
            'create' => \App\Filament\Resources\Posts\Pages\CreatePost::route('/create'),
            'view'   => \App\Filament\Resources\Posts\Pages\ViewPost::route('/{record}'),
            'edit'   => \App\Filament\Resources\Posts\Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
