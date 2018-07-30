<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TCG\Voyager\Traits\Seedable;

class Install extends Command
{
    use Seedable;

    protected $seedersPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the app + seed data';

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
        $this->seedersPath = database_path('seeds').'/';

        $this->call('migrate:fresh');

        $this->call('voyager:install');
        $this->call('voyager-blog:install');
        $this->call('voyager-pages:install');

        $this->call('db:seed');
    }
}
