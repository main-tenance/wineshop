<?php

namespace App\Services\Vines;


use App\Models\Vine;
use App\Services\Vines\Handlers\VineCreateHandler;
use App\Services\Vines\Handlers\VineUpdateHandler;
use App\Services\Vines\Repositories\VinesRepository;
use Illuminate\Support\Collection;

class VinesService
{
    private VinesRepository $vinesRepository;
    private VineCreateHandler $vineCreateHandler;
    private VineUpdateHandler $vineUpdateHandler;

    public function __construct(
        VinesRepository   $vinesRepository,
        VineCreateHandler $vineCreateHandler,
        VineUpdateHandler $vineUpdateHandler
    )
    {
        $this->vinesRepository = $vinesRepository;
        $this->vineCreateHandler = $vineCreateHandler;
        $this->vineUpdateHandler = $vineUpdateHandler;
    }

    public function getAll(): Collection
    {
        return $this->vinesRepository->getAll();
    }

    public function store(array $data): Vine
    {
        return $this->vineCreateHandler->handle($data);
    }

    public function update(Vine $vine, array $data): Vine
    {
        return $this->vineUpdateHandler->handle($vine, $data);
    }

    public function delete(Vine $vine): void
    {
        $this->vinesRepository->delete($vine);
    }

}
