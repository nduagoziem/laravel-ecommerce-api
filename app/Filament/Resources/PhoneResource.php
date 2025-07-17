<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Phone;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PhoneResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PhoneResource extends Resource
{
    protected static ?string $model = Phone::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder("Vivo V23")
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('phone_images')
                    ->collection('phone_images')
                    ->visibility('public')
                    ->responsiveImages()
                    ->multiple(true)
                    ->placeholder("Maximum of 5 images")
                    ->maxFiles(5)
                    ->image()
                    ->label('Upload Phone Images')
                    ->panelLayout('grid')
                    ->previewable(true)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₦'),
                Forms\Components\Select::make('brand')
                    ->options([
                        "samsung",
                        "ios",
                        "vivo",
                        "tecno",
                        "redmi",
                        "infinix",
                        "huawei",
                        "oppo",
                        "nokia",
                        "itel"
                    ])
                    ->required()
                    ->native(false)
                    ->label("Brand Name"),
                Forms\Components\TextInput::make('tags')
                    ->required()
                    ->placeholder("black, gray, slim")
                    ->maxLength(255),
                Forms\Components\TextInput::make('stock')
                    ->placeholder("How many are available?")
                    ->required()
                    ->label('In Stock')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('phone_images')
                    ->visible(false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money("NGN")
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListPhones::route('/'),
            'create' => Pages\CreatePhone::route('/create'),
            'edit' => Pages\EditPhone::route('/{record}/edit'),
        ];
    }
}
