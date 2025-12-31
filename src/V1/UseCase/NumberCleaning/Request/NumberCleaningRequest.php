<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\PhoneNumber;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 電話番号クリーニング
 */
final class NumberCleaningRequest implements NumberCleaningRequestInterface
{
    /**
     * @var Token
     */
    private readonly Token $token;

    /**
     * @var ClientId
     */
    private readonly ClientId $clientId;

    /**
     * @var PhoneNumber
     */
    private readonly PhoneNumber $phoneNumber;

    /**
     * @param string $phoneNumber
     */
    public function __construct(
        string $phoneNumber,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();

        $this->phoneNumber = new PhoneNumber($phoneNumber);
    }

    /**
     * @test
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'       => $this->token->value(),
            'clientId'    => $this->clientId->value(),
            'phoneNumber' => $this->phoneNumber->value(),
        ];
    }

    /**
     * @test
     * @return array
     */
    public function toArray(): array
    {
        $result = $this->toAll();

        foreach ($result as $key => $value) {
            if ($value === null) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}
