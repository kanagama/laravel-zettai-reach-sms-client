<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;

interface SeparatedSuccessCountDomainInterface
{
    /**
     * @param  SeparatedSuccessCountRequestInterface $request
     * @return array
     */
    public function execute(SeparatedSuccessCountRequestInterface $request): array;
}
