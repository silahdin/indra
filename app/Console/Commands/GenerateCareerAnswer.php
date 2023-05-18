<?php

namespace App\Console\Commands;

use App\Models\TestNewUserAnswer;
use App\Models\TestUserCareer;
use Illuminate\Console\Command;

class GenerateCareerAnswer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:career-answer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating Career ID to All Answer';

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
        $data = TestNewUserAnswer::whereNull('career_id')->orderBy('created_at');

        $data->chunkById(500, function($rows){
            foreach($rows as $row){
                try{
                    // $this->info($row->id);

                    $careerExist = TestNewUserAnswer::whereCode($row->code)->whereUserId($row->user_id)->whereNotNull('career_id')->pluck('career_id')->toArray();

                    // $this->info(implode(', ', $careerExist));

                    $userCareers = TestUserCareer::whereUserId($row->user_id)->whereNotIn('career_id', $careerExist)->orderBy('created_at')->first();

                    // $this->info($userCareers);

                    TestNewUserAnswer::whereId($row->id)->update(['career_id' => $userCareers->career_id]);

                    $this->info('UPDATED ID : ' . $row->id);

                }catch(\Exception $e){
                    // DO NOTHING
                }
            }
        });
    }
}
