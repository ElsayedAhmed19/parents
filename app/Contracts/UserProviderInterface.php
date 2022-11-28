<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface UserProviderInterface
{
    public function setQueryStringMapper(): array;

    public function setStatusMapper(): array;

    public function getParents(array $filters): Collection;
}
