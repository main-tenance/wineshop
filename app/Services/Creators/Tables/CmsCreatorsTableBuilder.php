<?php


namespace App\Services\Creators\Tables;


use App\Services\Creators\Repositories\CreatorsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tagedo\TableBuilder\TableBuilder;

class CmsCreatorsTableBuilder extends TableBuilder
{
    public function __construct(Request $request, CreatorsRepository $creatorsRepository)
    {
        $this->creatorsRepository = $creatorsRepository;
        $this->title = __('creators.h1');
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
            'code' => [
                'field' => 'code',
                'code' => 'code',
                'caption' => 'Символьный код',
                'style' => 'width: 200px; align: left; flex-grow: 1;',
                'class' => '',
                'sortby' => true,
            ],
            'name' => [
                'field' => 'name',
                'code' => 'name',
                'caption' => 'Название',
                'style' => 'width: 300px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'original' => [
                'field' => 'original',
                'code' => 'original',
                'caption' => 'Оригинальное название',
                'style' => 'width: 300px; align: left;',
                'class' => '',
                'sortby' => true,
            ],
            'description' => [
                'field' => 'description',
                'code' => 'description',
                'caption' => 'Описание',
                'style' => 'width: 350px; align: right;',
                'class' => '',
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
            $this->fields['code'],
            $this->fields['name'],
            $this->fields['original'],
            $this->fields['trash'],
        ];
    }


    protected function setClickable()
    {
        $this->clickable = true;
    }

    public function getAll(): Collection
    {
        return $this->creatorsRepository->getAll($this->sortField, $this->sortDirection);
    }

    public function getBody(): Collection
    {
        $key = 'cms-creators-table-page' . $this->sortField . '-' . $this->sortDirection . '-' . $this->offset . '-' . $this->countByPage;
        $items = Cache::tags('creators')->remember($key, 120, function () {
            return $this->format($this->all->slice($this->offset, $this->countByPage));
        });

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
