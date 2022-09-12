<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserTelegramLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('telega')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Telega'))
                ->placeholder(__('Telega')),
        ];
    }
}
