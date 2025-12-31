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
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\TemplateDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\TemplateDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\NumberCleaningDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\NumberCleaningDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\SeparatedSuccessCountDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\SeparatedSuccessCountDomain::class,
        );

        //
        // Http
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface::class,
            \Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface::class,
            \Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse::class,
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