<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(Category::class, 'slug', fn ($record) => $record),
                            ]),
                        Forms\Components\BelongsToSelect::make('parent_id')
                            ->label('Parent')
                            ->relationship('parent', 'name', fn (Builder $query) => $query->where('parent_id', null))
                            ->searchable()
                            ->placeholder('Select parent category'),
                        Forms\Components\TextInput::make('position')
                            ->numeric()
                        ->nullable(),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible to customers.')
                            ->default(true),
                        Forms\Components\MarkdownEditor::make('description')
                            ->label('Description'),
                        Forms\Components\TextInput::make('seo_title')
                            ->maxLength(60),
                        Forms\Components\TextInput::make('seo_description')
                            ->maxLength(160),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (?Category $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (?Category $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('parent_id'),
//                Forms\Components\TextInput::make('name')
//                    ->required()
//                    ->maxLength(255),
//                Forms\Components\TextInput::make('slug')
//                    ->required()
//                    ->maxLength(255),
//                Forms\Components\Textarea::make('description'),
//                Forms\Components\TextInput::make('position')
//                    ->required(),
//                Forms\Components\Toggle::make('is_visible')
//                    ->required(),
//                Forms\Components\TextInput::make('seo_title')
//                    ->maxLength(60),
//                Forms\Components\TextInput::make('seo_description')
//                    ->maxLength(160),
//            ]);
//    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\BooleanColumn::make('is_visible'),
                Tables\Columns\TextColumn::make('seo_title'),
                Tables\Columns\TextColumn::make('seo_description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
