<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperadorResource\Pages;
use App\Filament\Resources\OperadorResource\RelationManagers;
use App\Models\Operador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OperadorResource extends Resource
{
    protected static ?string $model = Operador::class;
    protected static ?string $recordTitleAttribute = 'nombre';


    protected static ?string $modelLabel = 'operador';

    protected static ?string $pluralModelLabel = 'operadores';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Datos Principales')
                    ->schema([Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),
                        Forms\Components\TextInput::make('usuario')
                            ->maxLength(255)
                            ->required()
                            ->label('Usuario APP'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                                $component->state('');
                            })
                            ->dehydrateStateUsing(fn($state) => md5($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),
                    ])
                    ->columns(4),

                Forms\Components\Fieldset::make('Datos Generales')
                    ->schema([
                        Forms\Components\TextInput::make('licencia')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tipo_licencia')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('vence'),
                        Forms\Components\TextInput::make('imss')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rfc')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('curp')
                            ->maxLength(255),
                    ])
                    ->columns(6),
                Forms\Components\Fieldset::make('Otros')
                    ->schema([
                        Forms\Components\DatePicker::make('fecha_nacimiento'),
                        Forms\Components\DatePicker::make('fecha_ingreso'),
                        Forms\Components\TextInput::make('tarjeta_bancaria')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('banco')
                            ->maxLength(255),
                    ])
                    ->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('fecha_ingreso')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('licencia')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tipo_licencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vence')
                    ->date()
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('imss')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('rfc')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('curp')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tarjeta_bancaria')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('banco')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListOperadors::route('/'),
            'create' => Pages\CreateOperador::route('/create'),
            'edit' => Pages\EditOperador::route('/{record}/edit'),
        ];
    }
}
