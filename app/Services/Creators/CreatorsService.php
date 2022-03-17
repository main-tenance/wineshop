<?php


namespace App\Services\Creators;

use App\Jobs\QueueName;
use App\Jobs\SendCreatorPdfCatalogJob;
use App\Models\Creator;
use App\Models\User;
use App\Services\Creators\Handlers\CreatorCreateHandler;
use App\Services\Creators\Handlers\CreatorSendPdfCatalogHandler;
use App\Services\Creators\Handlers\CreatorUpdateHandler;
use App\Services\Creators\Repositories\CreatorsRepository;
use Illuminate\Support\Collection;

class CreatorsService
{
    /**
     * @var CreatorsRepository
     */
    private CreatorsRepository $creatorsRepository;
    /**
     * @var CreatorCreateHandler
     */
    private CreatorCreateHandler $createCreatorHandler;
    /**
     * @var CreatorUpdateHandler
     */
    private CreatorUpdateHandler $updateCreatorHandler;

    public function __construct(
        CreatorsRepository           $creatorsRepository,
        CreatorCreateHandler         $createCreatorHandler,
        CreatorUpdateHandler         $updateCreatorHandler,
        CreatorSendPdfCatalogHandler $creatorSendPdfCatalogHandler
    )
    {
        $this->creatorsRepository = $creatorsRepository;
        $this->createCreatorHandler = $createCreatorHandler;
        $this->updateCreatorHandler = $updateCreatorHandler;
        $this->creatorSendPdfCatalogHandler = $creatorSendPdfCatalogHandler;
    }

    public function getAllSortedCreators(string $sortField = 'id', string $sortDirection = 'asc')
    {
        return $this->creatorsRepository->getAll($sortField, $sortDirection);
    }


    public function getCreatorByCodeWithOffers($code)
    {
        return $this->creatorsRepository->getByCodeWithOffers($code);
    }

    public function getCreators(int $limit = 20, int $offset = 0): Collection
    {
        return $this->creatorsRepository->getBy([], $limit, $offset);
    }


    public function createCreator(array $data): Creator
    {
        return $this->createCreatorHandler->handle($data);
    }


    public function updateCreator(Creator $creator, array $data): Creator
    {
        return $this->updateCreatorHandler->handle($creator, $data);
    }

    public function destroy(Creator $creator)
    {
        $creator->delete();
    }

    public function prepareCache()
    {
        $this->creatorsRepository->prepareCache();
    }

    public function sendPdfCatalog(User $user, Creator $creator): void
    {
        SendCreatorPdfCatalogJob::dispatch($user, $creator);
    }

}
