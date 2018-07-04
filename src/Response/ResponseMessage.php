<?php

namespace SPie\WienerLinien\Response;

/**
 * Class ResponseMessage
 *
 * @package SPie\WienerLinien\Response
 */
class ResponseMessage implements ResponseObjectInterface
{

    const MESSAGE_CODE_OK                         = 1;
    const MESSAGE_CODE_ERROR_DB_NOT_AVAILABLE     = 311;
    const MESSAGE_CODE_ERROR_STATION_NOT_EXISTING = 312;
    const MESSAGE_CODE_ERROR_MAX_REQUESTS         = 316;
    const MESSAGE_CODE_ERROR_SENDER_NOT_EXISTING  = 317;
    const MESSAGE_CODE_ERROR_NO_DATA_IN_DB        = 322;

    const ATTRIBUTE_NAME_MESSAGE_VALUE = 'value';
    const ATTRIBUTE_NAME_MESSAGE_CODE  = 'messageCode';
    const ATTRIBUTE_NAME_SERVER_TIME   = 'serverTime';

    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $messageCode;

    /**
     * @var \DateTime
     */
    private $serverTime;

    /**
     * ResponseMessage constructor.
     *
     * @param string    $value
     * @param int       $messageCode
     * @param \DateTime $serverTime
     */
    public function __construct(string $value, int $messageCode, \DateTime $serverTime)
    {
        $this->value       = $value;
        $this->messageCode = $messageCode;
        $this->serverTime  = $serverTime;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getMessageCode(): int
    {
        return $this->messageCode;
    }

    /**
     * @return \DateTime
     */
    public function getServerTime(): \DateTime
    {
        return $this->serverTime;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_MESSAGE_VALUE] ?? null,
            $response[self::ATTRIBUTE_NAME_MESSAGE_CODE] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_SERVER_TIME])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_SERVER_TIME])
                : null
        );
    }
}