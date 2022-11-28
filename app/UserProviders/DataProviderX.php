<?php

namespace App\UserProviders;

use App\Contracts\UserProviderInterface;
use App\Repositories\ParentRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DataProviderX implements UserProviderInterface
{
    private array $queryStringMapper = [];

    private array $statusMapper = [];

    private string $providerPath = '';

    public function __construct(private ParentRepository $parentRepository)
    {
        $this->providerPath = Storage::path('public/providerX.json');

        $this->queryStringMapper = $this->setQueryStringMapper();

        $this->statusMapper = $this->setStatusMapper();
    }

    public function setQueryStringMapper(): array
    {
        $this->queryStringMapper = [
            'statusCode' => 'statusCode',
            'balanceMin' => 'parentAmount',
            'balanceMax' => 'parentAmount',
            'currency' => 'Currency',
            'registerationDate' => 'registerationDate',
            'parentEmail' => 'parentEmail'
        ];

        return $this->queryStringMapper;
    }

    public function setStatusMapper(): array
    {
        $this->statusMapper = [
            'authorised' => 1,
            'decline' => 2,
            'refunded' => 3
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
