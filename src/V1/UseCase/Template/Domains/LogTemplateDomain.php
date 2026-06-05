<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;

final class LogTemplateDomain implements TemplateDomainInterface, LogTemplateDomainInterface
{
    /**
     * @param  FakeTemplateDomain  $fakeTemplateDomain
     */
    public function __construct(
        private readonly FakeTemplateDomainInterface $fakeTemplateDomain,
    ) {
    }

    /**
     * @param  TemplateRequest  $request
     * @return array
     */
    public function execute(TemplateRequestInterface $request): array
    {
        Log::info('zettaiReachSms template() Skipped.');

        return $this->fakeTemplateDomain->execute($request);
    }
}
