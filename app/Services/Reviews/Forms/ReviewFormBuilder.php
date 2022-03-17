<?php

namespace App\Services\Reviews\Forms;


use App\Forms\FormBuilder;


abstract class ReviewFormBuilder extends FormBuilder
{

    public function setFields()
    {
        $this->fields = [
            'id' => [
                'name' => 'id',
                'type' => 'hidden',
            ],
            'rating' => [
                'name' => 'rating',
                'type' => 'text',
                'label' => 'Оценка',
                'style' => 'width: 100%;',
            ],
            'comment' => [
                'name' => 'comment',
                'type' => 'text',
                'label' => 'Комментарий',
                'style' => 'width: 100%;',
            ],
            'to_publish' => [
                'name' => 'to_publish',
                'type' => 'checkbox',
                'label' => 'Разрешаю опубликовать',
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
