<?php

use Illuminate\Support\Facades\Route;

$webhook = app()->make(\Tj\Ghwebhook\Webhook::class);
$config = $webhook->payload->config;

Route::post($config['path'], [\Tj\Ghwebhook\Http\WebhookController::class, 'index'])->name($config['path'])->middleware('ghwebhook.log.request','ghwebhook.verify.signature');
