<?php

namespace App\Services\Discounts\Forms;


use App\Forms\FormBuilder;


abstract class CmsDiscountFormBuilder extends FormBuilder
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
                'style' => 'width: 100%;',
            ],
            'active_from' => [
                'name' => 'active_from',
                'type' => 'date',
                'label' => 'Активна с',
                'style' => 'width: 100%;',
            ],
            'active_to' => [
                'name' => 'active_to',
                'type' => 'date',
                'label' => 'Активна по',
                'style' => 'width: 100%;',
            ],
            'discount_type' => [
                'name' => 'discount_type',
                'type' => 'select',
                'label' => 'Тип скидки',
                'style' => 'width: 100%;',
                'values' => [
                    ['id' => 'P', 'name' => 'В процентах'],
                    ['id' => 'S', 'name' => 'В рублях'],
                    ['id' => 'F', 'name' => 'Фиксированная цена'],
                ]
            ],
            'discount_value' => [
                'name' => 'discount_value',
                'type' => 'text',
                'label' => 'Размер скидки',
                'style' => 'width: 100%;',
            ],
            'groups' => [
                'name' => 'groups',
                'type' => 'multiselect',
                'label' => 'Группы пользователей',
                'style' => 'width: 100%;',
                'values' => [
                    ['id' => 1, 'name' => 'Администратор'],
                    ['id' => 2, 'name' => 'Гость'],
                    ['id' => 3, 'name' => 'Авторизованный'],
                ]
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
