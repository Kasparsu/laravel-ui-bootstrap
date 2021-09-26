<?php

namespace Shahvirag\LaravelUiBootstrap;



class InstallBootstrap5Command extends InstallCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelui:bootstrap5
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes with bootstrap 5';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'bootstrap5/auth/login.blade.php' => 'auth/login.blade.php',
        'bootstrap5/auth/passwords/confirm.blade.php' => 'auth/passwords/confirm.blade.php',
        'bootstrap5/auth/passwords/email.blade.php' => 'auth/passwords/email.blade.php',
        'bootstrap5/auth/passwords/reset.blade.php' => 'auth/passwords/reset.blade.php',
        'bootstrap5/auth/register.blade.php' => 'auth/register.blade.php',
        'bootstrap5/auth/verify.blade.php' => 'auth/verify.blade.php',
        'bootstrap5/layouts/app.blade.php' => 'layouts/app.blade.php',
        'bootstrap5/home.blade.php' => 'home.blade.php',
        'bootstrap5/profile.blade.php' => 'profile.blade.php',
    ];

    /**
     * @var array
     */
    protected $resourceFiles = [
        'sass/_variables.scss' => 'sass/_variables.scss',
        'sass/app.scss' => 'sass/app.scss',
        'js/bootstrap.js' => 'js/bootstrap.js',
        'js/app.js' => 'js/app.js',
    ];

    protected $bootstrapPackages =  [
        'bootstrap' => '^4.0.0',
        'jquery' => '^3.2',
        'popper.js' => '^1.12',
        'sass' => '^1.15.2',
        'sass-loader' => '^8.0.0',
    ];

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
     */
    public function handle()
    {
        parent::handle();
    }
}
