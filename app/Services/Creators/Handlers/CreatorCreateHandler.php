<?php


namespace App\Services\Creators\Handlers;


use App\Models\Creator;
use App\Services\Codes\Repositories\CodesRepository;
use App\Services\Creators\Repositories\CreatorsRepository;

class CreatorCreateHandler
{

    private CreatorsRepository $creatorsRepository;


    public function __construct(
        CreatorsRepository $creatorsRepository,
        CodesRepository    $codesRepository
    )
    {
        $this->creatorsRepository = $creatorsRepository;
        $this->codesRepository = $codesRepository;
    }


    public function handle(array $data): Creator
    {
        $this->codesRepository->create($data);
        return $this->creatorsRepository->create($data);
    }


//    private function validateData(array $data): void
//    {
//        if (empty($data['name'])) {
//            throw new ValidationException('Name is required');
//        }
//    }

}
