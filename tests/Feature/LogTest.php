<?php
namespace Tj\Ghwebhook\Tests\Feature;

use Illuminate\Support\Facades\Log;
use Tj\Ghwebhook\Tests\TestCase;

class LogTest extends TestCase
{
    /** @test */
    public function it_should_log_incoming_request()
    {

        $path = config('ghwebhook.path');
        $response = $this->post($path);

    }
}
