<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Question\Question;

class ForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast {cities?* : separated by space}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows tabulated data of 5-day forecast';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = empty($this->argument('cities')) ? $this->promptForCities() : $this->argument('cities');

        $forecasts = $this->fetchForecasts($cities);
        $table = new Table($this->output);
        $table->setHeaders(['City', 'Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5']);

        foreach ($forecasts as $forecast) {
            $table->addRow([
                $forecast['city'],
                $forecast['dates_data'][0]['text'],
                $forecast['dates_data'][1]['text'],
                $forecast['dates_data'][2]['text'],
                $forecast['dates_data'][3]['text'],
                $forecast['dates_data'][4]['text'],
            ]);
        }

        $table->render();
    }

    protected function promptForCities()
    {
        $question = new Question('Enter cities (separated by space): ');
        $input = $this->askQuestion($question);

        return explode(' ', $input);
    }

    protected function askQuestion(Question $question)
    {
        $helper = $this->getHelper('question');

        return $helper->ask($this->input, $this->output, $question);
    }

    protected function fetchForecasts(array $cities)
    {
        $apiKey = env('WEATHER_API_KEY');
        $client = new Client();

        $forecasts = [];

        foreach ($cities as $city) {
            $url = "https://api.weatherbit.io/v2.0/forecast/daily?key=$apiKey&city=$city";
            $response = $client->get($url);

            $data = json_decode($response->getBody(), true);

            $forecasts[] = [
                'city' => $city,
                'dates_data' => $this->filterForecasts($data['data']),
            ];
        }

        return $forecasts;
    }

    protected function filterForecasts(array $data)
    {
        // Filter out today's date
        $time = date('H');

        // Get the next 5 days of forecasts
        $nextFiveDays = array_slice($data, 0, 5);
        if ($time > 12) {
            // If the time is over noon, get the next 5 days exclude today.
            $nextFiveDays = array_slice($data, 1, 6);
        }

        return array_map(function ($forecast) {
            return [
                'text' => "Avg:" . $forecast['temp'] . ", Max:" . $forecast['max_temp'] . ", Min:" . $forecast['min_temp'],
            ];
        }, $nextFiveDays);
    }
}
