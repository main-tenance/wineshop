<?php

namespace App\Services\Vines\Handlers;

use App\Models\Vine;
use App\Services\Codes\Repositories\CodesRepository;
use App\Services\Vines\Repositories\VinesRepository;

class VineUpdateHandler
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

    public function handle(Vine $vine, array $data): Vine
    {
        $oldCode = $vine->code;
        if ($oldCode === $data['code']) {
            return $this->vinesRepository->update($vine, $data);
        }

        $this->codesRepository->create($data);
        $vine = $this->vinesRepository->update($vine, $data);
        $this->codesRepository->deleteByCode($oldCode);

        return $vine;
    }

}
