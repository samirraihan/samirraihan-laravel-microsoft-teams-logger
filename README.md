# Samir Raihan Laravel Microsoft Teams Logger

A Laravel-compatible logger that sends messages to a Microsoft Teams webhook using Monolog.

## Installation

```bash
composer require samirraihan/laravel-microsoft-teams-logger
```

## Laravel Integration

## Publish Configuration File

```bash
php artisan vendor:publish --tag=config
```

## Set Environment Variables

```bash
TEAMS_WEBHOOK_URL=
TEAMS_LOG_LEVEL=error
```

## Add Custom Logging Channel (config/logging.php -> channels)

```bash
'stack' => [
    'driver' => 'stack',
    'channels' => ['single', 'teams'],
    'ignore_exceptions' => false,
],

'teams' => [
    'driver' => 'custom',
    'via' => MicrosoftTeamsLogger\TeamsLoggerFactory::class,
    'level' => env('TEAMS_LOG_LEVEL', 'error'),
    'webhookUrl' => env('TEAMS_WEBHOOK_URL'),
],
```