<?php

namespace App\Services\Creators\Handlers;

use App\Models\Code;
use App\Models\Creator;
use App\Services\Codes\Repositories\CodesRepository;
use App\Services\Creators\Repositories\CreatorsRepository;
use Illuminate\Support\Facades\DB;

class CreatorUpdateHandler
{

    private CreatorsRepository $creatorsRepository;
    private CodesRepository $codesRepository;


    public function __construct(
        CreatorsRepository $creatorsRepository,
        CodesRepository    $codesRepository
    )
    {
        $this->creatorsRepository = $creatorsRepository;
        $this->codesRepository = $codesRepository;
    }


    public function handle(Creator $creator, array $data): Creator
    {
        $oldCode = $creator->code;
        if ($oldCode === $data['code']) {
            return $this->creatorsRepository->update($creator, $data);
        }

        $this->codesRepository->create($data);
        $creator = $this->creatorsRepository->update($creator, $data);
        $this->codesRepository->delete($oldCode);

        return $creator;
    }


}
