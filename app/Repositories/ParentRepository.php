<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class ParentRepository
{
    public function getParents(
        array $queryStringMapper,
        array $statusMapper,
        string $providerPath,
        array $filters
    ): Collection
    {
        // TODO: move to Redis and update redis if file changes
        $allParents = collect(json_decode(file_get_contents($providerPath)));

        return $allParents
            ->when(
                isset($filters['statusCode']),
                fn($q) => $q->where($queryStringMapper['statusCode'], $statusMapper[$filters['statusCode']])
            )
            ->when(
                isset($filters['balanceMin']),
                fn($q) => $q->where($queryStringMapper['balanceMin'], '>=', $filters['balanceMin'])
            )
            ->when(
                isset($filters['balanceMax']),
                fn($q) => $q->where($queryStringMapper['balanceMax'], '<=', $filters['balanceMax'])
            )
            ->when(
                isset($filters['currency']),
                fn($q) => $q->where($queryStringMapper['currency'], $filters['currency'])
            )
            ->values();
    }
}
