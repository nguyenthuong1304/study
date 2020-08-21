<?php

namespace App\Repositories\Contracts;

interface TagRepositoryInterface extends BaseRepositoryContract
{
    public function getData($with = []);
}
