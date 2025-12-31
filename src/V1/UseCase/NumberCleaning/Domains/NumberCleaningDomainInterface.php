<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;

interface NumberCleaningDomainInterface
{
    /**
     * @param  NumberCleaningRequestInterface $request
     * @return array
     */
    public function execute(NumberCleaningRequestInterface $request): array;
}
