<?php


namespace App\Services\Discounts\Tables;


use App\Services\Discounts\Repositories\DiscountsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Tagedo\TableBuilder\TableBuilder;

class CmsDiscountsTableBuilder extends TableBuilder
{
    public function __construct(Request $request, DiscountsRepository $discountsRepository)
    {
        $this->discountsRepository = $discountsRepository;
        $this->title = __('discounts.h1');
        parent::__construct($request);
    }

    protected function setFields()
    {
        $this->fields = [
            'id' => [
                'field' => 'id',
                'code' => 'id',
                'caption' => 'Id',
                'style' => 'width: 100px; align: right;',
                'class' => '',
                'sortby' => true,
            ],
            'name' => [
                'field' => 'name',
                'code' => 'name',
                'caption' => 'Название',
                'style' => 'width: 300px; align: left; flex-grow: 1;',
                'class' => '',
                'sortby' => true,
            ],
            'active_from' => [
                'field' => 'active_from',
                'code' => 'active_from',
                'caption' => 'Активна с',
                'style' => 'width: 200px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'active_to' => [
                'field' => 'active_to',
                'code' => 'active_to',
                'caption' => 'Активна до',
                'style' => 'width: 200px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'discount_type' => [
                'field' => 'discount_type',
                'code' => 'discount_type',
                'caption' => 'Тип скидки',
                'style' => 'width: 100px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'discount_value' => [
                'field' => 'discount_value',
                'code' => 'discount_value',
                'caption' => 'Размер скидки',
                'style' => 'width: 100px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'trash' => [
                'field' => 'trash',
                'code' => 'trash',
                'caption' => 'Удалить',
                'style' => 'width: 100px; align: right;',
                'class' => 'nofollow',
                'unescaped' => true,
            ],
        ];
    }


    public function getFields()
    {
        return [
            $this->fields['id'],
            $this->fields['name'],
            $this->fields['active_from'],
            $this->fields['active_to'],
            $this->fields['discount_type'],
            $this->fields['discount_value'],
            $this->fields['trash'],
        ];
    }

    protected function setClickable()
    {
        $this->clickable = true;
    }

    public function getAll(): Collection
    {
        return $this->discountsRepository->getAll($this->sortField, $this->sortDirection);
    }

    public function getBody(): Collection
    {
        $items = $this->all->slice($this->offset, $this->countByPage);
        $items = $this->format($items);

        return $items;
    }


    protected function format(Collection $items): Collection
    {
        $items->transform(function ($item, $key) {
            $item['trash'] = '<span class="trash ashref"><i class="fas fa-times"></i></span>';
            return $item;
        });

        return $items;
    }
}
