<?php
/**
 * Created by PhpStorm.
 * User: 77056
 * Date: 07.05.2019
 * Time: 23:09
 */

namespace App\Repositories;

use App\Model\Calendar as Model;

class CalendarRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCalendarByRouteId($id)
    {
        $data = $this
            ->startConditions()
            ->where('route_id', $id)
            ->orderBy('date')
            ->get();

        return $data;
    }
}
