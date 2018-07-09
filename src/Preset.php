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
        static::updateGitignore();
        static::updateEditorConfig();
        static::updateControllers();
        static::updateRoutes();
        static::updateProviders();
        static::updateSupport();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'animate.css' => '^3.6.1',
            "normalize.css" => "^8.0.0",
            "js-cookie" => "^2.2.0",
            "slick-carousel" => "^1.8.1",
            "jquery-match-height" => "^0.7.2",
            'laravel-mix-purgecss' => '^2.2.0',
            'tailwindcss' => '>=0.5.3',
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
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));

            $files->copyDirectory(__DIR__.'/stubs/resources/assets', resource_path('assets'));
        });
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(resource_path('assets/sass'));
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));

            if (! $files->isDirectory($directory = resource_path('assets/Open/css'))) {
                $files->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/stubs/resources/assets/css/app.css', resource_path('assets/css/app.css'));
    }

    protected static function updateJavaScript()
    {
        copy(__DIR__.'/stubs/app.js', resource_path('assets/Open/js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/Open/js/bootstrap.js'));
    }

    protected static function createComponents()
    {
        tap(new Filesystem, function ($files) {
            if (! $files->isDirectory($directory = resource_path('assets/Open/components'))) {
                $files->makeDirectory($directory, 0755, true);
            }
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

    protected static function updateGitignore()
    {
        copy(__DIR__.'/stubs/gitignore-stub', base_path('.gitignore'));
    }

    protected static function updateEditorConfig()
    {
        copy(__DIR__.'/stubs/editorconfig-stub', base_path('.editorconfig'));
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

    protected static function updateSupport()
    {
        tap(new Filesystem, function ($files) {
            if (! $files->isDirectory($directory = base_path('app/Support'))) {
                $files->copyDirectory(__DIR__.'/stubs/Support', $directory);
            }
        });
    }
}
