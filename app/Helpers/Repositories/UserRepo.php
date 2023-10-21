<?php

namespace App\Helpers\Repositories;

use App\Models\User;

class UserRepo
{
    /**
     * @return User
     */
    public function model(): User
    {
        return new User();
    }// end of model function

    /**
     * @param $column
     * @param $value
     * @return object|null
     */
    public function find($column, $value): object|null
    {
        return $this->model()->query()->where($column, $value)->first();
    }// end of find function
}
