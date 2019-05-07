<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 07.05.2019
 * Time: 22:17
 */

namespace App\Repositories;

use App\Model\Route as Model;

class RouteRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $data = $this
            ->startConditions()
            ->toBase()
            ->get();

        return $data;
    }
}
