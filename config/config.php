<?php

return [
    // Relative path to serve webhook for incoming Github requests.
    'path' => 'gh-webhook/',

    // Route's name for the webhook
    'route' => 'gh.webhook',

    // Add `GHWEBHOOK_KEY` into your `.env` file to store secret string defined when creating the webhook.
    'secret' => env('GHWEBHOOK_KEY'),

    // Enable or disable the webhook route, on disabled the route will not be available therefor it will respond with 404, or depending on your setup.
    'enabled' => (bool) env('GHWEBHOOK_ENABLED', true),

    // Logs the incoming requests and post request action.
    'logging' => [
        // Channel to log the incoming requests. Make sure that the channel defined here exists in `config/logging.php`
        'channel' => 'default',
        // Exclude request body from log entry, default to true, change this to false if you want to log the request body.
        'exclude_body' => true,
    ],

    // Notification send when an exception occured during request handling or post action execution.
    // TODO: Enables this for the next release
    'notification' => [
        // Enables notification by changing the value into `true`, and define correctly the notifiable object.
        'enabled' => false,
        // Notifiable which will receive the notification in pattern of `{table}:{column},{value}` for examples for roles admin `roles:name,admin`
        'notifiable' => 'users:id,1',
    ],

    // Post request action configuration, disabled by default but shipped with the default on pulling the repository. More than one actions can be defined by adding the action class array.
    'actions' => [
        [
            // Disabled by default.
            'enabled' => false,
            // This action class executes `git pull` shell command on your `base_path()` of laravel application, assuming that the repository config is valid.
            'action' => \Tj\Ghwebhook\PullUpdatesAction::class,
        ],
        [
            'enabled' => false,
            'action' => \Tj\Ghwebhook\Actions\UpdatePackagesAction::class,
        ],
        [
            // Add more action by implementing 'Tj\GhWebhook\ActionInterface' where it should has a handle method to execute its task.
        ],
    ],

    'events' => [
        // True to enable the package dispatching events during processing or while an exception occured.
        'enabled' => false,

        // Dispatched as soon as the request is entering webhook routes. It has $event->request in its payload.
        'incoming' => \Tj\Ghwebhook\Events\IncomingRequestEvent::class,

        // Dispatched when incoming request is processed by actions defined when there are no exceptions occured.
        'completed' => \Tj\Ghwebhook\Events\WebhookActionCompletedEvent::class,

        // Dispatched when an exception occured during request proccessing.
        'exception' => \Tj\Ghwebhook\Events\WebhookErrorEvent::class,

        // Dispatched events will send all its public properties into the channel statet here if enabled.
        'broadcast_channel' => 'webhook-events',
    ],
];
