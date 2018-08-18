<?php

namespace Tests;

use Exception;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}

            public function report(Exception $exception) {}

            public function render($request, Exception $exception) {
                throw $exception;
            }
        });
    }

    public function assertValidationError($field, $response)
    {
        $response->assertStatus(422);
        $this->assertArrayHasKey($field, $response->decodeResponseJson('errors'));
    }

    public function ajaxGetRequest($url, $user = null)
    {
        if ($user) {
            $this->actingAs($user, 'api');
        }

        $reponse = $this->get($url, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        return $reponse;
    }
}
