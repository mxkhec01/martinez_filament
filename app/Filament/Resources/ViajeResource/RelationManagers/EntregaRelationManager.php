<?php

namespace App\Filament\Resources\ViajeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntregaRelationManager extends RelationManager
{
    protected static string $relationship = 'entregas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'razon_social')
                    ->searchable()
                    ->preload(),
                Forms\Components\Repeater::make('facturas')
//                    ->schema([
//                        Forms\Components\TextInput::make('numero_factura')->required()
//                        ,
//                    ])
                    ->simple(Forms\Components\TextInput::make('numero_factura')->required())
                ->relationship()
                ,

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('cliente_id')
            ->columns([
                Tables\Columns\TextColumn::make('cliente.razon_social'),
                Tables\Columns\TextColumn::make('facturas.numero_factura')
                ->badge()
                ,



            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
