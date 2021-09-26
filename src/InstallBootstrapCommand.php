<?php


namespace Shahvirag\LaravelUiBootstrap;

use Illuminate\Console\Command;

class InstallBootstrapCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelui:bootstrap
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes with latest available bootstrap';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(){
        $this->call('laravelui:bootstrap5');
    }
}