<?php

namespace Shahvirag\LaravelUiBootstrap;

use Illuminate\Console\Command;

abstract class InstallCommand extends Command
{

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
        $this->ensureDirectoriesExist();
        $this->exportViews();

        $this->updateRoute();

        $this->exportAssets();
        $this->updatePackage();
        $this->updateWebpackMix();

        $this->info('Bootstrap scaffolding installed successfully.');
        $this->warn('Run "npm install && npm run dev" to compile resources.');
    }

    /**
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        $directories = [
            $this->getViewPath('layouts'),
            $this->getViewPath('auth/passwords'),
            resource_path('sass'),
            resource_path('js'),
        ];

        foreach ($directories as $directory) {
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }
    }

    /**
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(__DIR__.'/../resources/views/'.$key, $view);
        }
    }

    /**
     * @param  string  $path
     * @return string
     */
    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }

    /**
     * @return void
     */
    protected function updateRoute()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../routes/web.php'),
            FILE_APPEND
        );
    }

    /**
     * @return void
     */
    protected function exportAssets()
    {
        foreach ($this->resourceFiles as $sourcePath => $destinationPath) {
            copy(__DIR__.'/../resources/'.$sourcePath, resource_path($destinationPath));
        }
    }

    /**
     * @return void
     */
    protected function updatePackage($dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $this->bootstrapPackages =  [
            'bootstrap' => '^4.0.0',
            'jquery' => '^3.2',
            'popper.js' => '^1.12',
            'sass' => '^1.15.2',
            'sass-loader' => '^8.0.0',
        ];

        $packages[$configurationKey] = array_merge(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $this->bootstrapPackages
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * @return void
     */
    protected function updateWebpackMix()
    {
        if (! file_exists(base_path('webpack.mix.js'))) {
            return;
        }

        file_put_contents(
            base_path('webpack.mix.js'),
            file_get_contents(__DIR__.'/../resources/webpack.mix.js'),
        );
    }
}
