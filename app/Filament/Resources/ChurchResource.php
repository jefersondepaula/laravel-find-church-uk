<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChurchResource\Pages;
use App\Filament\Resources\ChurchResource\RelationManagers;
use App\Models\Church;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToManyCheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\HasManyRepeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChurchResource extends Resource
{
    protected static ?string $model = Church::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Igreja')->Schema([
                    Select::make('user_id')
                        ->relationship('user', 'name') // Assuming 'name' is the attribute you want to display from the User model
                        ->required() // Makes this field required
                        ->reactive()
                        ->searchable() // Optional, to make searching easier if there are many users
                        ->label('User') ,// Optional, sets a human-readable label for the field // Displaying user's name in the select
                    TextInput::make('name'),
                    TextInput::make('latitude')
                        ->numeric()
                        ->step(0.00000001), // Adjust step for precision
                    TextInput::make('longitude')
                        ->numeric()
                        ->step(0.00000001),
                    Select::make('religion_id')
                        ->relationship('religion', 'name'), // Displaying religion's name in the select
                    Textarea::make('description')
                        ->nullable(),
                    TextInput::make('contact_info')
                        ->nullable(),
                    TextInput::make('website')
                        ->nullable(),
                    BelongsToManyCheckboxList::make('facilities')
                        ->relationship('facilities', 'name')
                        ->label('Facilidades'),
                    TextInput::make('phone_number')
                        ->nullable(),
                    Toggle::make('is_featured'),
                    DateTimePicker::make('featured_until')
                        ->nullable(),
            ])->collapsed(),

            Section::make('Services')->Schema([

                HasManyRepeater::make('services')
                ->relationship('services') // Este é o nome do método de relacionamento no modelo Church
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->label('Título'),
                    Textarea::make('description')
                        ->nullable()
                        ->label('Descrição'),
                    Select::make('day_of_week')
                        ->options([
                            1 => 'Domingo',
                            2 => 'Segunda-Feira',
                            3 => 'Terca-Feira'
                        ])
                        ->required()
                        ->label('Dia da Semana'),
                    TimePicker::make('service_time')
                        ->required()
                        ->label('Horário do Serviço'),
                    Select::make('language_id')
                        ->relationship('language', 'name') // Assumindo que 'name' é o atributo que você quer mostrar do modelo ServiceLanguage
                        ->nullable()
                        ->searchable()
                        ->label('Linguagem'),
                ])->label('Services'),
            ])->collapsed(),

            Section::make('Endereço')
                ->relationship('address')
                ->schema([
                    TextInput::make('address_line1')
                        ->label('Endereço Linha 1')
                        ->required(),
                    TextInput::make('address_line2')
                        ->label('Endereço Linha 2')
                        ->nullable(),
                    TextInput::make('town')
                        ->label('Cidade')
                        ->required(),
                    TextInput::make('county')
                        ->label('Condado')
                        ->required(),
                    TextInput::make('post_code')
                        ->label('Código Postal')
                        ->required(),
                    TextInput::make('latitude')
                        ->label('Latitude')
                        ->numeric()
                        ->nullable(),
                    TextInput::make('longitude')
                        ->label('Longitude')
                        ->numeric()
                        ->nullable(),
                ])->collapsible(),

            Section::make('Usuário Responsável')
                ->relationship('user')
                ->schema([
                    TextInput::make('name')
                        ->label('Usuário')
                        ->default(auth()->user()->name) // Define o valor padrão como o nome do usuário logado
                        ->disabled() // Torna o campo desabilitado (somente leitura)
                        ->visible(auth()->check()), // Certifica-se de que há um usuário logado
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('user.name') // Assuming you have a User model related to the Church
                    ->label('User'),
                TextColumn::make('religion.name') // Assuming you have a Religion model related to the Church
                    ->label('Religion'),
                BooleanColumn::make('is_featured')
                    ->label('Featured')
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-s-star'),
                // You can add more columns as needed, depending on what information you think is relevant to display
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
            'index' => Pages\ListChurches::route('/'),
            'create' => Pages\CreateChurch::route('/create'),
            'edit' => Pages\EditChurch::route('/{record}/edit'),
        ];
    }
}
