<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getParents($filters): Collection;
}
