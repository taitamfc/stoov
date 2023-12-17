<?php

namespace App\Console\Commands;

use App\Course;
use Illuminate\Console\Command;

class SyncBoekjaarCourseCommand extends Command
{
    /**
     * php artisan sync:course-boekjaa
     *
     * @var string
     */
    protected $signature = 'sync:course-boekjaar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any document is being expired(3 days remaining)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $courses = Course::where('boekjaar', null)->whereType(Course::TYPE_LOONSOMOPGAVE)->get();

        foreach($courses as $course) {
            $course->boekjaar = $course->created_at->format('Y');
            $course->save();
        }
        $this->info('Successfully');
    }
}
