<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Console\Command;
use App\Models\User;
use App\Http\Controllers\EmailController;

class Prospect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder message to clients via their mail';

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
        $users = User::all();

        foreach ($users as $user) {
            if($user->is_prospect) {
                 return EmailController::sendEmailReminder($user->id);
            }
        }

    }
}
