<?php

declare(strict_types=1);

namespace Cbenjafield\Aviary\Unit;

use Cbenjafield\Aviary\AviaryServiceProvider;
use Cbenjafield\Aviary\Facades\AviaryFacade;
use Cbenjafield\Aviary\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class CreateMessageTest extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);
        $app->register(AviaryServiceProvider::class);
    }

    public function testCanCreateMessage(): void
    {
        Http::fake([
            'https://aviaryplatform.com/api/v1/messages' => Http::response([
                'id' => 1,
                'recipient' => '+447123456789',
            ], 201)
        ]);

        $response = AviaryFacade::createMessage('+447123456789', 'Hello, world!');

        $this->assertEquals([
            'id' => 1,
            'recipient' => '+447123456789',
        ], $response);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://aviaryplatform.com/api/v1/messages' &&
                $request['recipient'] === '+447123456789' &&
                $request['message'] === 'Hello, world!';
        });
    }
}