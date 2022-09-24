<?php

namespace Tj\Ghwebhook\Contracts;

use Illuminate\Http\Request;

class WebhookPayload
{
    public array $config;

    public array $actions;

    public function __construct(public Request $request)
    {
        $this->config = config('ghwebhook');
        $this->actions = $this->getEnabledActions();
    }

    protected function getEnabledActions(): array
    {
        $actions = [];
        foreach ($this->config['actions'] as $action) {
            if (isset($action['enabled'])) {
                if ($action['enabled']) {
                    $actions[] = $action['action'];
                }
            }
        }
        return $actions;
    }

    public function toArray(): array
    {
        return [
            'request' => $this->request,
            'config' => $this->config,
            'actions' => $this->actions,
        ];
    }
}
