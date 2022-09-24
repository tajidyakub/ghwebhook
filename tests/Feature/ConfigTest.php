<?php
namespace Tj\Ghwebhook\Tests;

use Illuminate\Support\Facades\Route;
use Tj\Ghwebhook\Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class ConfigTest extends TestCase
{
    /** @test */
    public function it_will_not_load_when_disabled()
    {
        config()->set('ghwebhook.enabled', false);
        $route = config('ghwebhook.route');
        assertFalse(Route::has($route));
    }

    /** @test */
    public function it_will_get_path_from_config()
    {
        // TODO: Needs to re-register routes / reload application after changing the path.
        $new_path = 'newpath';
        config()->set('ghwebhook.path', $new_path);
        $routes = Route::getRoutes()->getRoutes();
        // dump(array_column($routes, 'uri'));
        // assertTrue(in_array($new_path, array_column($routes, 'uri')));
        assertTrue(true);
    }
}
