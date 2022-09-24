<?php

namespace Tj\Ghwebhook\Http;

use Closure;
use Illuminate\Http\Request;

class VerifySignatureMiddleware
{
    /**
     * Verify signature on the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $verified = false;
        $req_signature = $request->header('X-Hub-Signature-256', false);

        if ($req_signature) {
            $webhook = app()->make(\Tj\Ghwebhook\Webhook::class);
            $verified = $webhook->verifySignature($req_signature);
        }

        if (! $verified) {
            return response()->json([
                'error' => 1,
                'message' => 'Invalid request signature.',
                'data' => [],
            ], 403);
        }

        return $next($request);
    }
}
