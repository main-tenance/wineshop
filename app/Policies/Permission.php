<?php


namespace App\Policies;


abstract class Permission
{
    const VIEW_ANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
}
