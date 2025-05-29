<?php

namespace MicrosoftTeamsLogger;

use Monolog\Logger;

class TeamsLoggerFactory
{
    public function __invoke(array $config)
    {
        $logger = new Logger('teams');

        $handler = new TeamsHandler(
            $config['webhookUrl'] ?? config('teams-logger.webhook_url'),
            Logger::toMonologLevel($config['level'] ?? config('teams-logger.level', Logger::ERROR))
        );

        $logger->pushHandler($handler);

        return $logger;
    }
}
