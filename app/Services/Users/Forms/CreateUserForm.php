<?php


namespace App\Services\Users\Forms;


class CreateUserForm extends UserForm
{
    public function getFields()
    {
        $fields = [
            $this->fields['name'],
            $this->fields['last_name'],
            $this->fields['email'],
            $this->fields['login'],
            $this->fields['password'],
            $this->fields['password_confirmation'],
            $this->fields['phone'],
        ];

        return $fields;
    }


    public function getMethod()
    {
        return 'POST';
    }

}
