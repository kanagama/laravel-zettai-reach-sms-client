<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;

interface SendDomainInterface
{
    /**
     * @param  SendRequestInterface $request
     * @return array
     */
    public function execute(SendRequestInterface $request): array;
}
