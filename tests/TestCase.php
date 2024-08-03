<?php

declare(strict_types=1);

namespace Cbenjafield\Aviary\Tests;

use \Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('aviary.api_endpoint', 'https://aviaryplatform.com/api');
        $this->app['config']->set('aviary.api_key', 'test-api-key');

        if (! defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }
    }

    protected function getPackageProviders($app): array
    {
        return [
            \Cbenjafield\Aviary\AviaryServiceProvider::class
        ];
    }
}