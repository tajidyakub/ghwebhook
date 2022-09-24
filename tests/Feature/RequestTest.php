<?php
namespace Tj\Ghwebhook\Tests\Feature;

use Tj\Ghwebhook\Tests\TestCase;

class RequestTest extends TestCase
{
    /** @test */
    public function it_will_return_403_if_without_signature()
    {
        $response = $this->post('gh-webhook/');
        $response->assertStatus(403);
    }

    /** @test */
    public function it_will_return_403_if_signature_is_invalid()
    {
        $signature = "sha256=" . hash_hmac('sha256','invalid data',config('ghwebhook.key'));

        $response = $this->withHeaders(['X-Hub-Signature-256' => $signature])->post('gh-webhook/', ['hello' => 'test']);
        ray($response);
        $response->assertStatus(403);
    }

    /** @test */
    public function it_will_return_200_if_signature_valid()
    {
        // TODO: Use GuzzleHttp to perform a more flexible http request testing.
        $post_data = ['test' => 'data'];
        $signature = "sha256=" . hash_hmac('sha256',json_encode($post_data),config('ghwebhook.key'));

        // $response = $this->withHeaders(['X-Hub-Signature-256' => $signature])->json('POST', 'gh-webhook', $post_data);

        //ray($response);
        //$response->assertStatus(200);
    }
}
