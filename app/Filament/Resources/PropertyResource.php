<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Property Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Select::make('type')
                            ->required()
                            ->options([
                                'house' => 'House',
                                'apartment' => 'Apartment',
                                'villa' => 'Villa',
                                'land' => 'Land',
                            ]),
                        Forms\Components\TextInput::make('bedrooms')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('bathrooms')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('land_size')
                            ->numeric()
                            ->suffix('m²'),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('city')
                            ->required(),
                        Forms\Components\TextInput::make('state')
                            ->required(),
                        Forms\Components\TextInput::make('zip_code')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'sold' => 'Sold',
                                'rented' => 'Rented',
                                'pending' => 'Pending',
                            ])
                            ->default('active'),
                        Forms\Components\Toggle::make('is_featured')
                            ->default(false),
                        Forms\Components\TagsInput::make('features')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('property-images')
                            ->multiple()
                            ->maxFiles(5)
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Images')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor(),
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'sold' => 'danger',
                        'rented' => 'warning',
                        'pending' => 'info',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('property-images')
                    ->circular(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'house' => 'House',
                        'apartment' => 'Apartment',
                        'villa' => 'Villa',
                        'land' => 'Land',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'sold' => 'Sold',
                        'rented' => 'Rented',
                        'pending' => 'Pending',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
