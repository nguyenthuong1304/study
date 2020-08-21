<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BaseRepositoryContract
{
    public function getData($with = []);
}
