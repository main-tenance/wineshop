<?php


namespace App\Services\Reviews\Forms;


class ReviewCreateFormBuilder extends ReviewFormBuilder
{
    public function getFields()
    {
        $fields = [
            $this->fields['rating'],
            $this->fields['comment'],
            $this->fields['to_publish'],
        ];

        return $fields;
    }

    public function getMethod()
    {
        return 'POST';
    }

}
