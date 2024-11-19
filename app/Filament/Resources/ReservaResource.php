<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservaResource\Pages;
use App\Filament\Resources\ReservaResource\RelationManagers;
use App\Models\Reserva;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservaResource extends Resource
{
    protected static ?string $model = Reserva::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(fn() => \App\Models\Cliente::pluck('identificacion', 'id'))
                    ->required(),
                Forms\Components\DateTimePicker::make('fecha')
                    ->label('Fecha')
                    ->required(),
                Forms\Components\TextInput::make('numeroPersonas')
                    ->label('Número de personas')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('mesa_id')
                    ->label('Mesa')
                    ->options(fn() => \App\Models\Mesa::pluck('numeroMesa', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.identificacion')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numeroPersonas')
                    ->label('Número de personas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mesa.numeroMesa')
                    ->label('Mesa')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListReservas::route('/'),
            'create' => Pages\CreateReserva::route('/create'),
            'edit' => Pages\EditReserva::route('/{record}/edit'),
        ];
    }
}
