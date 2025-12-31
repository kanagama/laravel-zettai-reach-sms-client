<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;

interface StatusDomainInterface
{
    /**
     * @param  StatusRequestInterface $request
     * @return array
     */
    public function execute(StatusRequestInterface $request): array;
}
