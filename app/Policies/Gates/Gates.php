<?php


namespace App\Policies\Gates;

abstract class Gates
{
    const VIEW_SECRET_CONTENT = 'view_secret_content';
    const UPDATE_SETTINGS = 'update_settings';

    public static array $gates = [
        self::VIEW_SECRET_CONTENT,
        self::UPDATE_SETTINGS,
    ];
}
