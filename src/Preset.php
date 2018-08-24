<?php
namespace Coppee\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;

class Preset extends BasePreset
{
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateAssets();
        // static::updateStyles();
        static::updateWebpackConfiguration();
        // static::updateJavaScript();
        static::updateTemplates();
        static::updateLangFiles();
        static::removeNodeModules();
        static::updateControllers();
        static::updateRoutes();
        static::updateProviders();
        static::addSupport();
        static::addRepositories();
        static::updateConfig();
        static::updateHttpKernel();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'animate.css' => '^3.6.1',
            "normalize.css" => "^8.0.0",
            "js-cookie" => "^2.2.0",
            "slick-carousel" => "^1.8.1",
            "jquery-match-height" => "^0.7.2"
        ], Arr::except($packages, [
            'vue',
            'bootstrap-sass',
        ]));
    }

    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    protected static function updateAssets()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(resource_path('assets/sass'));
            $files->deleteDirectory(resource_path('assets/js'));
            $files->deleteDirectory(public_path('js'));
            $files->deleteDirectory(public_path('css'));

            $files->copyDirectory(__DIR__.'/stubs/resources/assets', resource_path('assets'));
        });
    }

    protected static function updateTemplates()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->copyDirectory(__DIR__.'/stubs/resources/views', resource_path('views'));
        });
    }

    protected static function updateLangFiles()
    {
        tap(new Filesystem, function ($files) {
            $files->copyDirectory(__DIR__.'/stubs/resources/lang', resource_path('lang'));
        });
    }

    protected static function updateControllers()
    {
        tap(new Filesystem, function ($files) {
            $files->copyDirectory(__DIR__.'/stubs/Controllers', base_path('app/Http/Controllers'));
        });
    }

    protected static function updateRoutes()
    {
        copy(__DIR__.'/stubs/routes/open.php', base_path('routes/open.php'));
    }

    protected static function updateProviders()
    {
        copy(__DIR__.'/stubs/Providers/AppServiceProvider.php', base_path('app/Providers/AppServiceProvider.php'));
        copy(__DIR__.'/stubs/Providers/NavigationServiceProvider.php', base_path('app/Providers/NavigationServiceProvider.php'));
        copy(__DIR__.'/stubs/Providers/RouteServiceProvider.php', base_path('app/Providers/RouteServiceProvider.php'));
    }

    protected static function addSupport()
    {
        tap(new Filesystem, function ($files) {
            if (! $files->isDirectory($directory = base_path('app/Support'))) {
                $files->copyDirectory(__DIR__.'/stubs/Support', $directory);
            }
        });
    }

    protected static function addRepositories()
    {
        tap(new Filesystem, function ($files) {
            if (! $files->isDirectory($directory = base_path('app/Repositories'))) {
                $files->copyDirectory(__DIR__.'/stubs/Repositories', $directory);
            }
        });
    }

    protected static function updateConfig()
    {
        copy(__DIR__.'/stubs/config/app.php', base_path('config/app.php'));
    }

    protected static function updateHttpKernel()
    {
        copy(__DIR__.'/stubs/Http/Kernel.php', base_path('app/Http/Kernel.php'));
    }
}
