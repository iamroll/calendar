<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarRequest;
use App\Repositories\CalendarRepository;
use App\Repositories\RouteRepository;

class CalendarController extends Controller
{

    private $routeRepository;
    private $calendarRepository;

    public function __construct()
    {
        parent::__construct();
        $this->routeRepository = app(RouteRepository::class);
        $this->calendarRepository = app(CalendarRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param CalendarRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CalendarRequest $request)
    {
        $calendar = [];
        if (isset($request['route']))  {
            $calendar = $this
                ->calendarRepository
                ->getCalendarByRouteId($request['route']);
        }
        $routes = $this->routeRepository->getAll();

        return view('welcome', compact('calendar', 'routes'));
    }

}
