<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyCounselor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:counselor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifier un conseiller des taches';

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
        Mail::to('info@test.com')->queue(new TestMail());
        $this->info('Successfully sent daily quote to everyone.');
    }
}
