<?php


namespace App\Services\Creators\Forms;


class CmsCreatorCreateFormBuilder extends CmsCreatorFormBuilder
{
    public function getFields()
    {
        $fields = [
            $this->fields['name'],
            $this->fields['code'],
            $this->fields['original'],
            $this->fields['description'],
        ];

        return $fields;
    }

    public function getMethod()
    {
        return 'POST';
    }
}
