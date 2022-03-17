<?php


namespace App\Services\Creators\Repositories;


use App\Models\Creator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class CreatorsRepository
{
    public function getAll(string $sortField = 'name', string $sortDirection = 'asc'): Collection
    {
        $remember = Creator::remember(120)->cacheTags('creators');
        $all = $sortDirection == 'desc' ?
            $remember->orderByDesc($sortField)->get() :
            $remember->orderBy($sortField)->get();

        return $all;
    }


    public function getBy(array $filters, int $limit, int $offset): Collection
    {
        $qb = Creator::query();
        $this->applayFilters($qb, $filters);
        $qb->take($limit);
        $qb->skip($offset);

        return $qb->orderBy('name')->get();
    }

    public function getByCodeWithOffers($code)
    {
        return Creator::where('code', $code)->with('offers')->first();
    }

    public function getByWithWines(array $filters, int $limit, int $offset): Collection
    {
        $collection = $this->getBy($filters, $limit, $offset);
        $collection->load('wines');

        return $collection;
    }


    public function create(array $data): Creator
    {
        return Creator::create($data);
    }


    public function update(Creator $creator, array $data): Creator
    {
        $creator->update($data);

        return $creator;
    }

    private function applayFilters(Builder $qb, array $filters): void
    {
        if (!empty($filters['name'])) {
            $qb->where('name', 'LIKE', $filters['name']);
        }

    }

    public function prepareCache()
    {
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderBy('id')->get();
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderByDesc('id')->get();
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderBy('name')->get();
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderByDesc('name')->get();
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderBy('code')->get();
        Creator::remember(60 * 60 * 24)->cacheTags('creators')->orderByDesc('code')->get();
        echo "Creators are cached\n";
    }

    public function getWinesByCreator(Creator $creator): Collection
    {
        $wines = DB::table('wines')
            ->where('creator_id', $creator->id)
            ->leftJoin('countries', 'countries.id', '=', 'wines.country_id')
            ->leftJoin('areas', 'areas.id', '=', 'wines.area_id')
            ->leftJoin('colors', 'colors.id', '=', 'wines.color_id')
            ->select('wines.id', 'wines.name', 'wines.original', 'wines.description',
                'countries.name as country', 'areas.name as area', 'colors.name as color')
            ->get();

        $wines->transform(function ($item, $key) {
            $item->offers = DB::table('offers')
                ->where('wine_id', $item->id)
                ->leftJoin('sugars', 'sugars.id', '=', 'offers.sugar_id')
                ->select('offers.wine_id', 'offers.active', 'offers.name', 'offers.code',
                    'sugars.name as sugar', 'offers.spirt', 'offers.volume', 'offers.year', 'offers.price')
                ->get();
            return $item;
        });

        return $wines;
    }

}
