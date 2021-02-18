<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NotifyInactiveUser;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email inactive users who did not logged in to our system for 7 days or long.';

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
     * @return int
     */
    public function handle()
    {
        $limit = now()->subDays(7);

        $inactiveUsers = User::where('last_login_at', '<', $limit)->get();

        foreach ($inactiveUsers as $user)
        {
            $user->notify(new NotifyInactiveUser());
            $this->info('Email sent to ' . $user->email . ' successfully');
        }
    }
}
