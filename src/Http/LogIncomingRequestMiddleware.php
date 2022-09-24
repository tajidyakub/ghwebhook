<?php

namespace Tj\Ghwebhook\Http;

use Closure;
use Illuminate\Http\Request;
use Tj\Ghwebhook\Concerns\InteractsWithLog;
use Tj\Ghwebhook\LogType;

class LogIncomingRequestMiddleware
{
    use InteractsWithLog;

    protected LogType $type = LogType::DEBUG;

    /**
     * Verify signature on the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, \Tj\Ghwebhook\Webhook $webhook)
    {
        $context = [
            'event' => $request->header('X-GitHub-Event', null),
            'delivery' => $request->header('X-GitHub-Delivery', null),
            'hook_id' => $request->header('X-GitHub-Hook-ID', null),
        ];

        if (! $webhook->payload->config['logging.exclude_body']) {
            $context['req_body'] = $request->getContent();
        }

        $this->log(LogType::DEBUG, 'Incoming request on Ghwebhook', $context);

        return $next($request);
    }
}
