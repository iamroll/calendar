<?php

namespace App\Console\Commands;

use App\Model\Calendar;
use App\Repositories\RouteRepository;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FillCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills calendar with new data';

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $routeRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->routeRepository = app(RouteRepository::class);
    }

    /**
     * Execute the console command.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $routes = $this->routeRepository->getAll();

        foreach ($routes as $route) {
            $flights = $this->getFlights($route->fly_from, $route->fly_to);
            foreach ($flights as $flight) {
                $fly = $this->checkFlight($flight->booking_token);
                if ($fly->flights_invalid or $fly->price_change) {
                    continue;
                }
                Calendar::create([
                    'route_id' => $route->id,
                    'price' => $flight->price,
                    'date' => Carbon::createFromTimestamp($flight->dTime)
                ]);
            }
        }
    }

    /**
     * Get all the cheapest flights.
     *
     * @param $fly_from
     * @param $fly_to
     * @return \Illuminate\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getFlights($fly_from, $fly_to)
    {
        $client = new Client();
        $date_now = Carbon::now();
        $response = $client->request('GET', 'https://api.skypicker.com/flights', [
            'query' => [
                'fly_from' => $fly_from,
                'fly_to' => $fly_to,
                'date_from' => $date_now->format('d/m/Y'),
                'data_to' => $date_now->addMonth()->format('d/m/Y')
            ]
        ]);
        $response = json_decode($response->getBody()->getContents());
        $data = collect($response->data);
        $flights = $data->where('price', $data->min('price'));

        return $flights;
    }

    /**
     * If flight already checked return it, else check it.
     *
     * @param $booking_token
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkFlight($booking_token)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://booking-api.skypicker.com/api/v0.1/check_flights', [
            'query' => [
                'v' => 2,
                'booking_token' => $booking_token,
                'bnum' => 3,
                'pnum' => 2,
                'affily' => 'picky_{market}',
                'currency' => 'USD',
                'visitor_uniqid' => 'e3b0c44298fc1c149afbf 4c8996fb92427ae41e4649b934ca495991b7852b855',
                'adults' => 1,
                'children' => 0,
                'infants' => 1,
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        if (!$response->flights_checked) {
            return $this->checkFlight($booking_token);
        }
        return $response;
    }

}
