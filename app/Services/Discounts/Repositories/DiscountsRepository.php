<?php


namespace App\Services\Discounts\Repositories;


use App\Models\Discount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class DiscountsRepository
{
    public function getAll(string $sortField = 'id', string $sortDirection = 'asc'): Collection
    {
        $all = Discount::all();
        $all = $sortDirection == 'desc' ? $all->sortByDesc($sortField) : $all->sortBy($sortField);
        return $all;
    }


    public function getBy(array $filters, int $limit, int $offset): Collection
    {
        $qb = Discount::query();
        $this->applayFilters($qb, $filters);
        $qb->take($limit);
        $qb->skip($offset);

        return $qb->orderBy('name')->get();
    }


    public function getByWithGroups(array $filters, int $limit, int $offset): Collection
    {
        $collection = $this->getBy($filters, $limit, $offset);
        $collection->load('groups');

        return $collection;
    }


    public function create(array $data): Discount
    {
        return Discount::create($data);
    }


    public function update(Discount $discount, array $data): Discount
    {
        $discount->update($data);

        return $discount;
    }


    public function setGroups(Discount $discount, array $data): void
    {
        $discount->groups()->detach();
        $discount->groups()->attach($data['groups']);
    }

    private function applayFilters(Builder $qb, array $filters): void
    {
        if (!empty($filters['name'])) {
            $qb->where('name', 'LIKE', $filters['name']);
        }

    }
}
