<?php

namespace App\Services\Vines\Handlers;

use App\Models\Vine;
use App\Services\Codes\Repositories\CodesRepository;
use App\Services\Vines\Repositories\VinesRepository;

class VineCreateHandler
{

    private VinesRepository $vinesRepository;
    private CodesRepository $codesRepository;

    public function __construct(
        VinesRepository $vinesRepository,
        CodesRepository $codesRepository
    )
    {
        $this->vinesRepository = $vinesRepository;
        $this->codesRepository = $codesRepository;
    }

    public function handle(array $data): Vine
    {
        $this->codesRepository->create($data);

        return $this->vinesRepository->create($data);
    }
}
