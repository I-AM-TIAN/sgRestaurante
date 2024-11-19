<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('producto_id')
                    ->label('Producto')
                    ->options(Producto::all()->pluck('nombre', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set, $state) => $set('valor', Producto::find($state)?->precio ?? 0))
                    ->required(),
                Forms\Components\TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set, $state, $get) => $set('total', $state * $get('valor')))
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->numeric(),
                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->searchable()
                    ->options(Cliente::all()->pluck('identificacion', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.identificacion')
                    ->label('Identificacion del cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVenta::route('/create'),
            'edit' => Pages\EditVenta::route('/{record}/edit'),
        ];
    }

    public static function create(array $data): Venta
    {
        return DB::transaction(function () use ($data) {
            $venta = Venta::create($data);
            if (!$venta) {
                throw new \Exception('Failed to create Venta');
            }
            $producto = Producto::find($data['producto_id']);
            if ($producto) {
                $producto->disminuirStock($data['cantidad']);
            }
            return $venta;
        });
    }
}