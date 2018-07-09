<?php
namespace Coppee\LaravelPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class PresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('coppee', function ($command) {
            Preset::install();

            $command->info('Coppee scaffolding installed successfully.');
            $command->info('Please run "yarn install && yarn watch" to compile your fresh scaffolding.');
        });
    }
}
