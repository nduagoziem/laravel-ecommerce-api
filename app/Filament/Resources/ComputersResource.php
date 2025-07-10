<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Computers;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ComputersResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ComputersResource\RelationManagers;

class ComputersResource extends Resource
{
    protected static ?string $model = Computers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder("HP Elite Book")
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('computer_images')
                    ->collection('computer_images')
                    ->visibility('public')
                    ->multiple(true)
                    ->placeholder("Maximum of 5 images")
                    ->maxFiles(5)
                    ->image()
                    ->label('Upload Computer Images')
                    ->panelLayout('grid')
                    ->previewable(true)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₦'),
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->label("Brand Name")
                    ->placeholder("hp")
                    ->maxLength(255),
                Forms\Components\TextInput::make('stock')
                    ->placeholder("How many are available??")
                    ->required()
                    ->label('In Stock')
                    ->numeric(),
                Forms\Components\TextInput::make('tags')
                    ->required()
                    ->placeholder("black, hp, dell")
                    ->maxLength(255),
                RichEditor::make('description')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('Computer_Images')
                    ->fileAttachmentsVisibility('public')
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
                Tables\Columns\TextColumn::make('brand')
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
            'index' => Pages\ListComputers::route('/'),
            'create' => Pages\CreateComputers::route('/create'),
            'edit' => Pages\EditComputers::route('/{record}/edit'),
        ];
    }
}
