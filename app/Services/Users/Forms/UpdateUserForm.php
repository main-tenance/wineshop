<?php


namespace App\Services\Users\Forms;

class UpdateUserForm extends UserForm
{

    public function getFields()
    {
        $fields = [
            $this->fields['id'],
            $this->fields['name'],
            $this->fields['last_name'],
            $this->fields['login'],
            $this->fields['email'],
            $this->fields['phone'],
        ];

        return $fields;
    }


    public function getMethod()
    {
        return 'PUT';
    }

}
