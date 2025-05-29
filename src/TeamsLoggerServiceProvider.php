<?php

namespace MicrosoftTeamsLogger;

use Illuminate\Support\ServiceProvider;

class TeamsLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/teams-logger.php' => config_path('teams-logger.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/teams-logger.php', 'teams-logger');
    }
}
