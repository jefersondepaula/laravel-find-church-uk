<?php

namespace App\Filament\Resources\ChurchResource\Pages;

use App\Filament\Resources\ChurchResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateChurch extends CreateRecord
{
    protected static string $resource = ChurchResource::class;

//    protected function mutateFormDataBeforeSave(array $data): array
//    {
//        $data['user_id'] = auth()->id();
//        return $data;
//    }
}
