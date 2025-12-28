<?php

namespace App\Filament\Resources\Posts;

use App\Models\Post;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use App\Filament\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

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
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, $set) => 
                    $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique('posts', 'slug', ignoreRecord: true),

            RichEditor::make('body')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDirectory('posts/content')
                ->fileAttachmentsVisibility('public'),

            FileUpload::make('featured_image')
                ->label('Featured Image')
                ->image()
                ->disk('public')
                ->directory('posts/featured')
                ->visibility('public')
                ->maxSize(5120)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '16:9',
                    '4:3',
                    '1:1',
                ])
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth(1200)
                ->imageResizeTargetHeight(675)
                ->columnSpanFull()
                ->helperText('Upload a high-quality featured image (recommended: 1200x675px, 16:9 ratio)'),

            TextInput::make('image_alt_text')
                ->label('Alt Text for Featured Image')
                ->maxLength(255)
                ->columnSpanFull(),

            FileUpload::make('gallery_images')
                ->label('Gallery Images')
                ->image()
                ->disk('public')
                ->multiple()
                ->directory('posts/gallery')
                ->visibility('public')
                ->maxFiles(10)
                ->maxSize(5120)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(800)
                ->imageResizeTargetHeight(600)
                ->reorderable()
                ->columnSpanFull()
                ->helperText('Upload multiple images for the gallery (max 10 images, 5MB each)'),

            FileUpload::make('content_images')
                ->label('Content Images')
                ->helperText('Upload images that can be inserted into your content using the rich editor.')
                ->image()
                ->disk('public')
                ->multiple()
                ->directory('posts/content')
                ->visibility('public')
                ->maxFiles(20)
                ->maxSize(5120)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth(1000)
                ->reorderable()
                ->columnSpanFull(),
        ]);
    }

    /* ===================== TABLE ===================== */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->disk('public')
                    ->size(60)
                    ->defaultImageUrl('/images/placeholder.png')
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->checkFileExistence(false),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Post $record) =>
                        Str::limit($record->slug, 30)
                    ),

                TextColumn::make('gallery_images')
                    ->label('Gallery')
                    ->badge()
                    ->getStateUsing(fn (Post $record) =>
                        is_array($record->gallery_images)
                            ? count($record->gallery_images) . ' images'
                            : 'No gallery'
                    )
                    ->color(fn (Post $record) =>
                        $record->gallery_images ? 'success' : 'gray'
                    ),

                TextColumn::make('content_images')
                    ->label('Content')
                    ->badge()
                    ->getStateUsing(fn (Post $record) =>
                        is_array($record->content_images) && count($record->content_images) > 0
                            ? count($record->content_images) . ' content images'
                            : 'No content images'
                    )
                    ->color(fn (Post $record) =>
                        (is_array($record->content_images) && count($record->content_images) > 0) ? 'info' : 'gray'
                    ),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
