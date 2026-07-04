<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),

            Action::make('register')
                ->label('Register')
                ->url(route('filament.admin.auth.register')),
        ];
    }
}
