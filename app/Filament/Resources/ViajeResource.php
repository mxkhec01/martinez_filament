<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViajeResource\Pages;
use App\Filament\Resources\ViajeResource\RelationManagers;
use App\Models\Viaje;
use Filament\GlobalSearch\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViajeResource extends Resource
{
    protected static ?string $model = Viaje::class;
    protected static ?string $recordTitleAttribute = 'id';

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Viaje' => $record->id,
            'Destino' => $record->destino,
            'Entregas' => $record->entregas->count(),
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return ViajeResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('ver detalle')
                ->iconButton()
                ->icon('heroicon-s-eye')
                ->url(static::getUrl('view', ['record' => $record])),
            Action::make('Editar')
                ->iconButton()
                ->icon('heroicon-s-pencil')
                ->url(static::getUrl('edit', ['record' => $record]))
        ];
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('estado')
                    ->options(Viaje::ESTADO_SELECT)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('unidad_id')
                    ->relationship('unidad', 'nombre')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('operador_id')
                    ->relationship('operador', 'nombre')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('monto_pagado')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\DatePicker::make('fecha_pago'),
                Forms\Components\Textarea::make('destino')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('fecha_inicio'),
                Forms\Components\DatePicker::make('fecha_fin'),
                Forms\Components\Select::make('carga')
                    ->options(Viaje::CARGA_SELECT)
                    ->required()
                ,
                Forms\Components\Textarea::make('comentarios')
                    ->maxLength(16777215)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->numeric()
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('unidad.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('operador.nombre')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto_pagado')
                    ->money('mxn')
                    ->numeric('2','.',',')
                    ->sortable()
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('fecha_pago')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options(Viaje::ESTADO_SELECT
                    )
//                ->default('Activo')
                ,


            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\EntregaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListViajes::route('/'),
            'create' => Pages\CreateViaje::route('/create'),
            'edit' => Pages\EditViaje::route('/{record}/edit'),
            'view' => Pages\ViewViaje::route('/{record}')
        ];
    }
}
