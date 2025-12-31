<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;

interface TemplateDomainInterface
{
    /**
     * @param  TemplateRequestInterface $request
     * @return array
     */
    public function execute(TemplateRequestInterface $request): array;
}
