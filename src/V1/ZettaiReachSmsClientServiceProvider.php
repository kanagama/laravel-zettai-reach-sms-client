<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

use Illuminate\Support\ServiceProvider;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsDriver;

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
        // sendDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\ApiSendDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\LogSendDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\ApiSendDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\ApiSendDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\LogSendDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\LogSendDomain::class,
        );

        //
        // checkReservationDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\ApiCheckReservationDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\LogCheckReservationDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\ApiCheckReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\ApiCheckReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\LogCheckReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\LogCheckReservationDomain::class,
        );

        //
        // CancelReservationDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\ApiCancelReservationDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\LogCancelReservationDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\ApiCancelReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\ApiCancelReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\LogCancelReservationDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\LogCancelReservationDomain::class,
        );

        //
        // CancelReservationAll
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\ApiCancelReservationAllDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\LogCancelReservationAllDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\ApiCancelReservationAllDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\ApiCancelReservationAllDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\LogCancelReservationAllDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\LogCancelReservationAllDomain::class,
        );

        //
        // StatusDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\ApiStatusDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\LogStatusDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\ApiStatusDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\ApiStatusDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\LogStatusDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\LogStatusDomain::class,
        );

        //
        // ShorterUrlDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ApiShortenUrlDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\LogShortenUrlDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ApiShortenUrlDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ApiShortenUrlDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\LogShortenUrlDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\LogShortenUrlDomain::class,
        );

        //
        // TemplateDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\TemplateDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\ApiTemplateDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\LogTemplateDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\ApiTemplateDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\ApiTemplateDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\LogTemplateDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\LogTemplateDomain::class
        );

        //
        // NumberCleaningDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\NumberCleaningDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\ApiNumberCleaningDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\LogNumberCleaningDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\ApiNumberCleaningDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\ApiNumberCleaningDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\LogNumberCleaningDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\LogNumberCleaningDomain::class,
        );

        //
        // SeparatedSuccessCountDomain
        //
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\SeparatedSuccessCountDomainInterface::class,
            match (config('zettai-reach-sms.sms_driver')) {
                SmsDriver::getApi()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\ApiSeparatedSuccessCountDomain::class,
                SmsDriver::getFake() => \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomain::class,
                SmsDriver::getLog()  => \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\LogSeparatedSuccessCountDomain::class,
            },
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\ApiSeparatedSuccessCountDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\ApiSeparatedSuccessCountDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomain::class,
        );
        $this->app->bind(
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\LogSeparatedSuccessCountDomainInterface::class,
            \Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\LogSeparatedSuccessCountDomain::class,
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
