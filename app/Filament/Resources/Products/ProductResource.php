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
use Filament\Schemas\Components\Fieldset;
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
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Products';
    
    protected static ?string $modelLabel = 'product';
    
    // protected static ?string $navigationGroup = 'Catalog'; 
    protected static string | \UnitEnum | null $navigationGroup = 'Catalog';

    protected static ?string $pluralModelLabel = 'products';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 1;

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

                    
                    TextInput::make('power_range')
                        ->label('Power Range')
                        ->placeholder('e.g., 1000 kVA - 5000 kVA')
                        ->maxLength(255),

                    TextInput::make('price')
                        ->numeric()
                        ->prefix('$')
                        ->placeholder('0.00'),
                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Brief description for product cards and listings (max 500 characters)')
                        ->columnSpanFull(),

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

            Section::make('Specifications')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('generator_type_id')
                                ->relationship('generatorType', 'name')
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')->required(),
                                    TextInput::make('slug')->required(),
                                ]),
                            Select::make('controller_id')
                                ->relationship('controller', 'type')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->type}")
                                ->searchable()
                                ->preload(),
                            Select::make('engine_id')
                                ->relationship('engine', 'model')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->model}")
                                ->searchable()
                                ->preload(),
                            Select::make('alternator_id')
                                ->relationship('alternator', 'model')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->model}")
                                ->searchable()
                                ->preload(),
                        ]),

                    Fieldset::make('Power & Performance')
                        ->schema([
                            TextInput::make('prime_power_kva')
                                ->label('Prime Power (kVA)')
                                ->numeric(),
                            TextInput::make('standby_power_kva')
                                ->label('Standby Power (kVA)')
                                ->numeric(),
                            TextInput::make('fuel_consumption_100_percent')
                                ->label('Fuel Cons. 100% (L/h)')
                                ->numeric(),
                            TextInput::make('fuel_tank_capacity')
                                ->label('Fuel Tank (L)')
                                ->numeric(),
                            TextInput::make('noise_level_db')
                                ->label('Noise Level (dB)')
                                ->numeric(),
                        ])->columns(3),

                    Fieldset::make('Dimensions & Weight')
                        ->schema([
                            TextInput::make('length_mm')->label('Length (mm)')->numeric(),
                            TextInput::make('width_mm')->label('Width (mm)')->numeric(),
                            TextInput::make('height_mm')->label('Height (mm)')->numeric(),
                            TextInput::make('weight_kg')->label('Weight (kg)')->numeric(),
                        ])->columns(4),
                ]),

            Section::make('Features')
                ->schema([
                    Repeater::make('features')
                        ->label('Key Features')
                        ->schema([
                            TextInput::make('feature')
                                ->hiddenLabel()
                                ->required()
                                ->maxLength(255),
                        ])
                        ->addActionLabel('Add Feature')
                        ->columnSpanFull(),
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
        ])
        ->columns(1);
        
    }

    /* ===================== INFOLIST ===================== */
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])
                            ->schema([
                                TextEntry::make('title')
                                // ->size(\Filament\Infolists\Components\TextEntry\TextEntrySize::Large)
                                ->weight(\Filament\Support\Enums\FontWeight::Bold),
                                
                                TextEntry::make('status')
                                    ->badge()
                                    ->colors([
                                        'danger' => 'draft',
                                        'success' => 'published',
                                    ]),

                                TextEntry::make('is_featured')
                                    ->label('Featured')
                                    ->icon(fn (bool $state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
                            ]),
                    ]),
                
                Section::make('Description')
                    ->schema([
                        TextEntry::make('description')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ]),

                Section::make('Gallery')
                    ->schema([
                        ImageEntry::make('gallery_images')
                            ->hiddenLabel()
                            ->disk('public')
                            ->height(200)
                            ->extraImgAttributes([
                                'class' => 'rounded-lg shadow-md object-cover',
                            ]),
                    ])
                    ->visible(fn ($record) => !empty($record->gallery_images)),

                Section::make('Technical Specifications & Features')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            // Left Side: Specifications
                            RepeatableEntry::make('specifications')
                                ->label('Technical Specifications')
                                ->contained(false)
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextEntry::make('spec_name')
                                                ->hiddenLabel()
                                                ->weight(\Filament\Support\Enums\FontWeight::Bold),
                                            
                                            TextEntry::make('spec_value')
                                                ->hiddenLabel()
                                                ->alignRight(), 
                                        ])
                                        ->extraAttributes([
                                            'class' => 'border-b border-gray-100 dark:border-gray-800 py-2 last:border-0'
                                        ]),
                                ]),

                            // Right Side: Features
                            RepeatableEntry::make('features')
                                ->label('Key Features')
                                ->contained(false)
                                ->schema([
                                    TextEntry::make('feature')
                                        ->hiddenLabel()
                                        ->icon('heroicon-m-check-circle')
                                        ->color('success')
                                        ->extraAttributes(['class' => 'py-1']),
                                ]),
                        ]),
                ])
                ->columnSpanFull()
            ])
            ->columns(1);
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
            ->defaultSort('created_at', 'desc');
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