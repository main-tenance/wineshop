<?php

namespace App\Services\Locale;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleService
{
    const PARAMETER_LOCALE = 'locale';
    private $supportedLocales = [
        'en',
        'ru',
    ];

    public function isSupportedLocale(string $locale): bool
    {
        if (!$locale) {
            return false;
        }

        return in_array($locale, $this->supportedLocales);
    }

    public function localize(string $locale): void
    {
        App::setLocale($locale);
    }

}
