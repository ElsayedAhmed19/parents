<?php

namespace App\UserProviders;

use App\Contracts\UserProviderInterface;
use App\Repositories\ParentRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DataProviderY implements UserProviderInterface
{
    private array $queryStringMapper = [];

    private array $statusMapper = [];

    private string $providerPath = '';

    public function __construct(private ParentRepository $parentRepository)
    {
        $this->queryStringMapper = $this->setQueryStringMapper();

    $this->providerPath = Storage::path('public/providerY.json');

        $this->statusMapper = $this->setStatusMapper();
    }

    public function setQueryStringMapper(): array
    {
        $this->queryStringMapper = [
            'statusCode' => 'status',
            'balanceMin' => 'balance',
            'balanceMax' => 'balance',
            'currency' => 'currency',
            'registerationDate' => 'created_at',
            'parentEmail' => 'email'
        ];

        return $this->queryStringMapper;
    }

    public function setStatusMapper(): array
    {
        $this->statusMapper = [
            'authorised' => 100,
            'decline' => 200,
            'refunded' => 300
        ];

        return $this->statusMapper;
    }

    public function getParents(array $filters): Collection
    {
        return $this->parentRepository->getParents(
            $this->queryStringMapper,
            $this->statusMapper,
            $this->providerPath,
            $filters
        );
    }
}
