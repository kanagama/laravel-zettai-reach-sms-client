<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;

interface ShortenUrlDomainInterface
{
    /**
     * @param  ShortenUrlRequestInterface $request
     * @return array
     */
    public function execute(ShortenUrlRequestInterface $request): array;
}
