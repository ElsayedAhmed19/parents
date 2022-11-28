<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Repositories\ParentRepository;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    public $parents = [];

    // TODO: to be moved to env to prevent editing the code on run ime
    const PROVIDERS_PATH = 'App\UserProviders\\';

    const PROVIDERS = [
        'DataProviderX',
        'DataProviderY'
    ];

    public function __construct(public ParentRepository $repository)
    {  }

    public function getParents($filters): Collection
    {
        $parents = collect([]);

        if (isset($filters['provider'])) {
            $parents = $this->createProvider($filters['provider'])->getParents($filters);
        } else {
            foreach (self::PROVIDERS as $providerClass) {
                $parents = $parents->merge($this->createProvider($providerClass)->getParents($filters));
            }
        }
        return $parents;
    }

    private function createProvider($providerClass)
    {
        $provider = self::PROVIDERS_PATH . $providerClass;

        return (new $provider($this->repository));
    }
}

