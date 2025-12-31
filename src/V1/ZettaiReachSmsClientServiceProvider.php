<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

use Illuminate\Support\ServiceProvider;

final class ZettaiReachSmsClientServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/zettai-reach-sms.php', 'zettai-reach-sms');

        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient::class,
        );

        //
        // Domains
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomain::class,
        );

        //
        // Http
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse::class,
        );
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../../config/zettai-reach-sms.php' => config_path('zettai-reach-sms.php'),
            ],
            'zettai-reach-sms-config'
        );
    }
}