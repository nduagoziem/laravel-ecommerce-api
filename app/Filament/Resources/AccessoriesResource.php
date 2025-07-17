<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Accessories;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\AccessoriesResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AccessoriesResource extends Resource
{
    protected static ?string $model = Accessories::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder("Digital HD Camera")
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('accessories_images')
                    ->collection('accessories_images')
                    ->visibility('public')
                    ->responsiveImages()
                    ->multiple(true)
                    ->placeholder("Maximum of 5 images")
                    ->maxFiles(5)
                    ->image()
                    ->label('Upload Accessories Images')
                    ->panelLayout('grid')
                    ->previewable(true)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₦'),
                Forms\Components\TextInput::make('stock')
                    ->placeholder("How many are available?")
                    ->label('In Stock')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tags')
                    ->required()
                    ->placeholder("black, gray, camera, charger")
                    ->maxLength(255),
                RichEditor::make('description')
                    ->columnSpanFull()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->placeholder("Describe your product")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tags')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAccessories::route('/'),
            'create' => Pages\CreateAccessories::route('/create'),
            'edit' => Pages\EditAccessories::route('/{record}/edit'),
        ];
    }
}
