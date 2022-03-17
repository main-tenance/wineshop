<?php

namespace App\Services\Creators\Forms;


use App\Forms\FormBuilder;


abstract class CmsCreatorFormBuilder extends FormBuilder
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
                'type' => 'text',
                'label' => 'Название',
                'class' => '',
                'rules' => ['strlenFrom3To50'],
                'format' => ['doTrim'],
                'style' => 'width: 100%;',
            ],
            'code' => [
                'name' => 'code',
                'type' => 'text',
                'label' => 'Символьный код',
                'class' => '',
                'rules' => ['isSymbolicCode', 'strlenFrom3To50'],
                'format' => ['doTrim'],
                'style' => 'width: 100%;',
            ],
            'original' => [
                'name' => 'original',
                'type' => 'text',
                'label' => 'Оригинальное название',
                'class' => '',
                'rules' => ['isSymbolicCode', 'strlenFrom3To50'],
                'format' => ['doTrim'],
                'style' => 'width: 100%;',
            ],
            'description' => [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Описание',
                'class' => '',
                'rules' => [],
                'format' => ['doTrim'],
                'style' => 'width: 100%;',
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
