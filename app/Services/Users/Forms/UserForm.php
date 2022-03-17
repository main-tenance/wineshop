<?php


namespace App\Services\Users\Forms;


use App\Forms\FormBuilder;

abstract class UserForm extends FormBuilder
{

    public function setFields()
    {
        $this->fields = [
            'id' => [
                'name' => 'id',
                'type' => 'hidden',
            ],
            'name' => [
                'name' => 'name',
                'label' => 'Имя',
                'type' => 'text',
                'style' => 'width: 250px;',
            ],
            'last_name' => [
                'name' => 'last_name',
                'label' => 'Фамилия',
                'type' => 'text',
                'style' => 'width: 250px;',
            ],
            'email' => [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text',
                'style' => 'width: 250px;',
            ],
            'login' => [
                'name' => 'login',
                'label' => 'Логин',
                'type' => 'text',
                'style' => 'width: 250px;',
            ],
            'password' => [
                'name' => 'password',
                'label' => 'Пароль',
                'type' => 'password',
                'style' => 'width: 250px;',
            ],
            'password_confirmation' => [
                'name' => 'password_confirmation',
                'label' => 'Подтверждение пароля',
                'type' => 'password',
                'style' => 'width: 250px;',
            ],
            'phone' => [
                'name' => 'phone',
                'label' => 'Телефон',
                'type' => 'text',
                'style' => 'width: 250px;',
            ],
        ];
    }


    public function getButtons()
    {
        return [
            [
                'label' => 'Сохранить',
                'class' => 'btn save',
                'style' => 'width: 200px;',
            ],
        ];
    }

}
