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

                    TextInput::make('model_code')
                        ->label('Model Code')
                        ->maxLength(255),

                    Select::make('category')
                        ->label('Category')
                        ->options([
                            'High Power' => 'High Power',
                            'Industrial' => 'Industrial',
                            'Commercial' => 'Commercial',
                            'Residential' => 'Residential',
                            'Control System' => 'Control System',
                            'Other' => 'Other',
                        ])
                        ->required(),

                    
                    TextInput::make('power_range')
                        ->label('Power Range')
                        ->placeholder('e.g., 1000 kVA - 5000 kVA')
                        ->maxLength(255),


                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Brief description for product cards and listings (max 500 characters)')
                        ->columnSpanFull(),

                ])
                ->columns(2),



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
                                // ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')->required(),
                                    TextInput::make('slug')->required(),
                                ]),
                            Select::make('controller_id')
                                ->relationship('controller', 'type')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->type}")
                                // ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('brand')->required(),
                                    TextInput::make('type')->required(),
                                ]),
                            Select::make('engine_id')
                                ->relationship('engine', 'model')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->model}")
                                // ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('brand')->required(),
                                    TextInput::make('model')->required(),
                                ]),
                            Select::make('alternator_id')
                                ->relationship('alternator', 'model')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} - {$record->model}")
                                //->searchable()  
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('brand')->required(),
                                    TextInput::make('model')->required(),
                                    TextInput::make('type'),
                                ]),
                        ]),

                    Fieldset::make('Power & Performance')
                        ->schema([
                            TextInput::make('prime_power_kva')
                                ->label('Prime Power (kVA)')
                                ->numeric(),
                            TextInput::make('prime_power_kw')
                                ->label('Prime Power (kW)')
                                ->numeric(),
                            TextInput::make('standby_power_kva')
                                ->label('Standby Power (kVA)')
                                ->numeric(),
                            TextInput::make('standby_power_kw')
                                ->label('Standby Power (kW)')
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
                        ])->columns(4),

                    Fieldset::make('Dimensions & Weight')
                        ->schema([
                            TextInput::make('length_mm')->label('Length (mm)')->numeric(),
                            TextInput::make('width_mm')->label('Width (mm)')->numeric(),
                            TextInput::make('height_mm')->label('Height (mm)')->numeric(),
                            TextInput::make('weight_kg')->label('Weight (kg)')->numeric(),
                        ])->columns(4),

                    Section::make('Deep Technical Specifications')
                        ->statePath('technical_specifications')
                        ->schema([
                            Fieldset::make('General')
                                ->statePath('general')
                                ->schema([
                                    TextInput::make('frequency')->label('Frequency'),
                                    TextInput::make('emissions_level')->label('Emissions Level'),
                                    TextInput::make('insulation_class')->label('Insulation Class'),
                                    TextInput::make('protection_class')->label('Protection Class'),
                                ])->columns(2),
                            
                            Fieldset::make('Engine Details')
                                ->statePath('engine_details')
                                ->schema([
                                    TextInput::make('cylinders')->label('Cylinders')->numeric(),
                                    TextInput::make('aspiration')->label('Aspiration'),
                                    TextInput::make('cooling_system')->label('Cooling System'),
                                    TextInput::make('governor_type')->label('Governor Type'),
                                    TextInput::make('compression_ratio')->label('Compression Ratio'),
                                    TextInput::make('displacement')->label('Displacement'),
                                ])->columns(3),

                            Fieldset::make('Fuel Consumption (L/h)')
                                ->statePath('fuel_consumption_l_h')
                                ->schema([
                                    TextInput::make('50_percent_load')->label('50% Load')->numeric(),
                                    TextInput::make('75_percent_load')->label('75% Load')->numeric(),
                                    TextInput::make('100_percent_load')->label('100% Load')->numeric(),
                                    TextInput::make('standby_load')->label('Standby Load')->numeric(),
                                ])->columns(4),
                            
                            Fieldset::make('Dimensions & Weight (Detailed)')
                                ->statePath('dimensions_and_weight')
                                ->schema([
                                    TextInput::make('length_mm')->label('Length (mm)')->numeric(),
                                    TextInput::make('width_mm')->label('Width (mm)')->numeric(),
                                    TextInput::make('height_mm')->label('Height (mm)')->numeric(),
                                    TextInput::make('weight_kg')->label('Weight (kg)')->numeric(),
                                    TextInput::make('fuel_tank_capacity_liters')->label('Fuel Tank (L)')->numeric(),
                                ])->columns(5),

                            Fieldset::make('Noise Level')
                                ->statePath('noise_level')
                                ->schema([
                                    TextInput::make('db_at_7m')->label('dB @ 7m')->numeric(),
                                    TextInput::make('sound_pressure_level')->label('Sound Pressure Level')->numeric(),
                                ])->columns(2),

                            Fieldset::make('Battery')
                                ->statePath('battery')
                                ->schema([
                                    TextInput::make('voltage')->label('Voltage'),
                                    TextInput::make('capacity')->label('Capacity'),
                                ])->columns(2),
                        ])
                        ->collapsible(),
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
            ->columns(1)
            ->schema([
                // Header: Basic Info
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Product Title')
                                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                    ->size('lg')
                                    ->columnSpan(2),
                                TextEntry::make('status')
                                    ->badge()
                                    ->colors([
                                        'danger' => 'draft',
                                        'success' => 'published',
                                    ]),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('model_code')->label('Model Code'),
                                TextEntry::make('category')->label('Category')->badge(),
                                TextEntry::make('is_featured')
                                    ->label('Featured')
                                    ->icon(fn (bool $state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
                            ]),
                        TextEntry::make('short_description')
                            ->label('Short Description')
                            ->prose()
                            ->columnSpanFull(),
                    ]),

                // Power & Configuration
                Section::make('Power & Configuration')
                    ->schema([
                         Grid::make(4)
                            ->schema([
                                TextEntry::make('prime_power_kva')->label('Prime (kVA)'),
                                TextEntry::make('prime_power_kw')->label('Prime (kW)'),
                                TextEntry::make('standby_power_kva')->label('Standby (kVA)'),
                                TextEntry::make('standby_power_kw')->label('Standby (kW)'),
                                TextEntry::make('voltage')->label('Voltage'),
                                TextEntry::make('phases')->label('Phase'),
                                TextEntry::make('fuel')->label('Fuel Type'),
                                TextEntry::make('frequency')->label('Frequency'),
                            ])
                    ]),

                 // Components (Relationships)
                Section::make('Components')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('generatorType.name')->label('Generator Type'),
                                TextEntry::make('engine.model')
                                    ->label('Engine')
                                    ->formatStateUsing(fn ($record) => $record->engine ? "{$record->engine->brand} - {$record->engine->model}" : '-'),
                                TextEntry::make('alternator.model')
                                    ->label('Alternator')
                                    ->formatStateUsing(fn ($record) => $record->alternator ? "{$record->alternator->brand} - {$record->alternator->model}" : '-'),
                                TextEntry::make('controller.type')
                                    ->label('Controller')
                                    ->formatStateUsing(fn ($record) => $record->controller ? "{$record->controller->brand} - {$record->controller->type}" : '-'),
                            ])
                    ]),

                // Technical Specifications (JSON)
                Section::make('Technical Specifications')
                    ->schema([
                         // General
                         Section::make('General')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                         TextEntry::make('technical_specifications.general.frequency')->label('Frequency'),
                                         TextEntry::make('technical_specifications.general.emissions_level')->label('Emissions'),
                                         TextEntry::make('technical_specifications.general.insulation_class')->label('Insulation'),
                                         TextEntry::make('technical_specifications.general.protection_class')->label('Protection'),
                                    ])
                            ])->compact(),
                        
                        // Engine Details
                        Section::make('Engine Details')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('technical_specifications.engine_details.cylinders')->label('Cylinders'),
                                        TextEntry::make('technical_specifications.engine_details.aspiration')->label('Aspiration'),
                                        TextEntry::make('technical_specifications.engine_details.cooling_system')->label('Cooling'),
                                        TextEntry::make('technical_specifications.engine_details.governor_type')->label('Governor'),
                                        TextEntry::make('technical_specifications.engine_details.compression_ratio')->label('Compression'),
                                        TextEntry::make('technical_specifications.engine_details.displacement')->label('Displacement'),
                                    ])
                            ])->compact(),

                         // Fuel Consumption
                        Section::make('Fuel Consumption (L/h)')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        TextEntry::make('technical_specifications.fuel_consumption_l_h.50_percent_load')->label('50% Load'),
                                        TextEntry::make('technical_specifications.fuel_consumption_l_h.75_percent_load')->label('75% Load'),
                                        TextEntry::make('technical_specifications.fuel_consumption_l_h.100_percent_load')->label('100% Load'),
                                        TextEntry::make('technical_specifications.fuel_consumption_l_h.standby_load')->label('Standby Load'),
                                    ])
                            ])->compact(),

                         // Dimensions & Weight
                        Section::make('Dimensions & Weight')
                            ->schema([
                                Grid::make(5)
                                    ->schema([
                                        TextEntry::make('technical_specifications.dimensions_and_weight.length_mm')->label('Length (mm)'),
                                        TextEntry::make('technical_specifications.dimensions_and_weight.width_mm')->label('Width (mm)'),
                                        TextEntry::make('technical_specifications.dimensions_and_weight.height_mm')->label('Height (mm)'),
                                        TextEntry::make('technical_specifications.dimensions_and_weight.weight_kg')->label('Weight (kg)'),
                                        TextEntry::make('technical_specifications.dimensions_and_weight.fuel_tank_capacity_liters')->label('Fuel Tank (L)'),
                                    ])
                            ])->compact(),
                        
                         // Noise & Battery
                        Section::make('Noise & Battery')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        TextEntry::make('technical_specifications.noise_level.db_at_7m')->label('Noise (dB @ 7m)'),
                                        TextEntry::make('technical_specifications.noise_level.sound_pressure_level')->label('Sound Pressure'),
                                        TextEntry::make('technical_specifications.battery.voltage')->label('Battery Voltage'),
                                        TextEntry::make('technical_specifications.battery.capacity')->label('Battery Capacity'),
                                    ])
                            ])->compact(),
                    ])->collapsible(),

                // Features
                Section::make('Features')
                    ->schema([
                        RepeatableEntry::make('features')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('feature')
                                    ->hiddenLabel()
                                    ->icon('heroicon-m-check-circle')
                                    ->color('success'),
                            ])
                            ->grid(1),
                    ]),

                // Gallery
                Section::make('Gallery')
                    ->schema([
                        ImageEntry::make('gallery_images')
                            ->hiddenLabel()
                            ->disk('public')
                            ->size(200)
                            ->extraImgAttributes([
                                'class' => 'rounded-lg shadow-md object-cover',
                            ]),
                    ])
                    ->visible(fn ($record) => !empty($record->gallery_images)),
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
                
                TextColumn::make('model_code')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(20)
                    ->wrap(),
                
                TextColumn::make('prime_power_kva')
                    ->label('Prime (kVA)')
                    ->numeric()
                    ->sortable(),

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