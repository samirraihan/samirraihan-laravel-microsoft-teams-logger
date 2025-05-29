<?php

namespace MicrosoftTeamsLogger;

use Monolog\Logger;
use Monolog\LogRecord;
use Monolog\Handler\AbstractProcessingHandler;

class TeamsHandler extends AbstractProcessingHandler
{
    protected string $webhookUrl;

    public function __construct(string $webhookUrl, $level = Logger::ERROR, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->webhookUrl = $webhookUrl;
    }

    protected function write(LogRecord $record): void
    {
        $payload = [
            '@type' => 'MessageCard',
            '@context' => 'http://schema.org/extensions',
            'summary' => $record->message,
            'themeColor' => 'FF0000',
            'title' => 'Laravel Error Log',
            'sections' => [
                [
                    'activityTitle' => '**' . $record->level->getName() . '**',
                    'text' => $record->message,
                    'facts' => [
                        ['name' => 'Time', 'value' => $record->datetime->format('Y-m-d H:i:s')],
                    ],
                ],
            ],
        ];

        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($ch);
        curl_close($ch);
    }
}
