<?php

namespace Database\Factories;

use DateTime;
use Carbon\Carbon;
use App\Models\Recurrence;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{    
    public function definition()
    {   
        $dates = $this->generateDate();

        return [
            'start_date' => $dates['start_date'],
            'end_date'   => $dates['end_date'],
            'start_time' => $this->generateTime('start'),
            'end_time'   => $this->generateTime('end'),                       
        ];
    }

    public function recurrent()
    {
        return $this->state(function (array $attributes) {
            return [
                'start_date'    => NULL,
                'end_date'      => NULL,
                'recurrence_id' => Recurrence::factory(),
            ];
        });
    }

    /**
     * Generate the time checking if should be a start or end time.
     * End time will always be grater than the start time.
     *
     * @param  string $type Start or end time
     * @return string Formatted time (H:i:s)
     */
    private function generateTime(string $type): string
    {
        $hour = ($type === 'start') ? mt_rand(0, 13) : mt_rand(14, 23);

        $date = new DateTime();
        $date->setTime($hour, mt_rand(0, 59), 00);

        return $date->format('H:i:s');
    }

    /**
     * Generate date array containing start and end date for the post.
     *
     * @param  string $type Start or end date
     * @return string Formatted date (Y-m-d)
     */
    private function generateDate(): array
    {
        $year  = mt_rand(2021, 2025);
        $day   = mt_rand(1, 28); 
        $month = mt_rand(1, 12);        

        $date = Carbon::create($year, $month, $day, 0, 0, 0); 
        
        $dates['start_date'] = $date->format('d/m/Y');
        $dates['end_date']   = $date->addWeeks(rand(1, 10))->format('d/m/Y');

        return $dates;
    }
}
