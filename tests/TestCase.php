<?php

namespace Kanagama\ZettaiReachSmsClient\Tests;

use Illuminate\Contracts\Config\Repository;
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ZettaiReachSmsClientServiceProvider::class,
        ];
    }

    /**
     * @param  $app
     * @return void
     */
    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set('zettai-reach-sms.token', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
            $config->set('zettai-reach-sms.sms_code', '123456');
            $config->set('zettai-reach-sms.client_id', '000001');
            $config->set('zettai-reach-sms.timeout_seconds', 10);
        });

        // $app['config']->set('zettai-reach-sms.token', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
    }
}
