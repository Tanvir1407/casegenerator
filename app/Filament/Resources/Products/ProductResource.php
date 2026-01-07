<?php

namespace App\Filament\Resources\Products;

use App\Models\Product;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Filament\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ViewProduct;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Products';
    
    protected static ?string $modelLabel = 'product';
    
    protected static ?string $pluralModelLabel = 'products';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 2;

    /* ===================== FORM ===================== */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Basic Information')
                ->schema([
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
                        ->unique('products', 'slug', ignoreRecord: true),

                    Select::make('category')
                        ->options([
                            'High Power' => 'High Power',
                            'Industrial' => 'Industrial',
                            'Commercial' => 'Commercial',
                            'Residential' => 'Residential',
                            'Control System' => 'Control System',
                            'Other' => 'Other',
                        ])
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('category')
                                ->required()
                                ->maxLength(255)
                        ]),

                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Brief description for product cards and listings (max 500 characters)'),

                    TextInput::make('power_range')
                        ->label('Power Range')
                        ->placeholder('e.g., 1000 kVA - 5000 kVA')
                        ->maxLength(255),

                    TextInput::make('price')
                        ->numeric()
                        ->prefix('$')
                        ->placeholder('0.00'),
                ])
                ->columns(2),

            Section::make('Detailed Description')
                ->schema([
                    RichEditor::make('description')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products/content')
                        ->fileAttachmentsVisibility('public')
                        ->helperText('Use the rich editor to add detailed product information. You can insert images directly into the content.'),
                ])
                ->collapsible(),

            Section::make('Images')
                ->schema([
                    FileUpload::make('featured_image')
                        ->label('Featured Image')
                        ->image()
                        ->disk('public')
                        ->directory('products/featured')
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
                        ->directory('products/gallery')
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

                   
                ])
                ->collapsible(),

            Section::make('Documents')
                ->schema([
                    FileUpload::make('pdf_file')
                        ->label('Product PDF/Brochure')
                        ->disk('public')
                        ->directory('products/pdfs')
                        ->visibility('public')
                        ->maxSize(10240) // 10MB max
                        ->acceptedFileTypes(['application/pdf'])
                        ->downloadable()
                        ->previewable(false)
                        ->openable()
                        ->columnSpanFull()
                        ->helperText('Upload a PDF brochure, manual, or specification sheet (max 10MB)'),

                    TextInput::make('pdf_title')
                        ->label('PDF Display Title')
                        ->maxLength(255)
                        ->placeholder('e.g., Product Brochure, Technical Manual, Specifications')
                        ->columnSpanFull()
                        ->helperText('Optional: Custom title for the PDF file (if empty, will use filename)'),
                ])
                ->collapsible(),

            Section::make('Features & Specifications')
                ->schema([
                    Repeater::make('features')
                        ->label('Key Features')
                        ->schema([
                            TextInput::make('feature')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter a key feature'),
                        ])
                        ->addActionLabel('Add Feature')
                        ->columnSpanFull()
                        ->helperText('Add key product features (e.g., "Power range: 1000 kVA - 5000 kVA")'),

                    Repeater::make('specifications')
                        ->label('Technical Specifications')
                        ->schema([
                            TextInput::make('spec_name')
                                ->label('Specification')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Engine Type'),
                            TextInput::make('spec_value')
                                ->label('Value')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Perkins 1206C-E70TTA'),
                        ])
                        ->addActionLabel('Add Specification')
                        ->columnSpanFull()
                        ->helperText('Add detailed technical specifications'),
                ])
                ->collapsible(),

            Section::make('Settings')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            Toggle::make('is_featured')
                                ->label('Featured Product'),
                            
                            Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                ])
                                ->default('draft')
                                ->required(),

                            TextInput::make('sort_order')
                                ->label('Sort Order')
                                ->numeric()
                                ->default(0)
                                ->helperText('Lower numbers appear first'),
                        ])
                ])
                ->collapsible(),
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
                    ->square(),
                
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(20)
                    ->wrap(),
                
                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'High Power' => 'danger',
                        'Industrial' => 'warning',
                        'Commercial' => 'success',
                        'Residential' => 'info',
                        'Control System' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),
                
                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                
                IconColumn::make('pdf_file')
                    ->boolean()
                    ->label('PDF')
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->getStateUsing(fn ($record): bool => !empty($record->pdf_file)),
                
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                    ]),
                
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category'),
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    /* ===================== PAGES ===================== */
    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}