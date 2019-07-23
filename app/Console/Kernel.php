<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Sort;
use App\Models\Event;

use App\Models\Search;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // the call method
        $schedule->call(function () {
            $last_record =Search::orderBy('updated_at', 'desc')->first();
            if(!isset($last_record)){
                $last_time=$last_record->updated_at;
            }else{
                $last_time='0';
            }
            //add sorts
            $items=Sort::where("updated_at", '>=', $last_time)->get();
            foreach ($items as $item) {
                $index_search = Search::where('target_id', $item->id)
                    ->where('type', 'sort')
                    ->first();
                if ($index_search === null) {
                    $index_search = new Search;
                }
                $index_search->title = $item->name;
                $index_search->text = $item->content;
                $index_search->section_id = $item->section_id;
                $index_search->type = 'sort';
                $index_search->target_id=$item->id;
                $index_search->save();
            }
            $items=Event::where("updated_at", '>=', $last_time)->get();
            foreach ($items as $item) {
                $index_search = Search::where('target_id', $item->id)
                    ->where('type', 'event')
                    ->first();
                if ($index_search === null) {
                    $index_search = new Search;
                }
                $index_search->title = $item->name;
                $index_search->text = $item->content;
                $index_search->section_id = $item->section_id;
                $index_search->type = 'sort';
                $index_search->target_id=$item->id;
                $index_search->save();
            }






        })->everyThirtyMinutes();



        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
