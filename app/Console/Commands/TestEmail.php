<?php

namespace App\Console\Commands;

use App\Mail\ValidacionEmail;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user=user::find(1);
        mail::to($user->email)->send(new ValidacionEmail);
    }
}
