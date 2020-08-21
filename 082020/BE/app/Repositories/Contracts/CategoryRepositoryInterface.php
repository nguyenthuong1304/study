<?php


namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface extends BaseRepositoryContract
{
    public function getData($with = []);
}
