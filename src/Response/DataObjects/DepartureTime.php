<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class DepartureTime
 *
 * @package SPie\WienerLinien\Response
 */
class DepartureTime implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_TIME_PLANNED = 'timePlanned';
    const ATTRIBUTE_NAME_TIME_REAL    = 'timeReal';
    const ATTRIBUTE_NAME_COUNTDOWN    = 'countdown';

    /**
     * @var \DateTime
     */
    private $timePlanned;

    /**
     * @var \DateTime|null
     */
    private $timeReal;

    /**
     * @var int
     */
    private $countdown;

    /**
     * DepartureTime constructor.
     *
     * @param \DateTime      $timePlanned
     * @param \DateTime|null $timeReal
     * @param int            $countdown
     */
    public function __construct(\DateTime $timePlanned, ?\DateTime $timeReal, int $countdown)
    {
        $this->timePlanned = $timePlanned;
        $this->timeReal    = $timeReal;
        $this->countdown   = $countdown;
    }

    /**
     * @return \DateTime
     */
    public function getTimePlanned(): \DateTime
    {
        return $this->timePlanned;
    }

    /**
     * @return \DateTime|null
     */
    public function getTimeReal(): ?\DateTime
    {
        return $this->timeReal;
    }

    /**
     * @return int
     */
    public function getCountdown(): int
    {
        return $this->countdown;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            !empty($response[self::ATTRIBUTE_NAME_TIME_PLANNED])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_TIME_PLANNED])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_TIME_REAL])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_TIME_REAL])
                : null,
            $response[self::ATTRIBUTE_NAME_COUNTDOWN] ?? null
        );
    }
}