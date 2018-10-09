<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class TrafficTime
 *
 * @package SPie\WienerLinien\Response
 */
final class TrafficTime implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_START  = 'start';
    const ATTRIBUTE_NAME_END    = 'end';
    const ATTRIBUTE_NAME_RESUME = 'resume';

    /**
     * @var \DateTime|null
     */
    private $start;

    /**
     * @var \DateTime|null
     */
    private $end;

    /**
     * @var \DateTime|null
     */
    private $resume;

    /**
     * Time constructor.
     *
     * @param \DateTime|null $start
     * @param \DateTime|null $end
     * @param \DateTime|null $resume
     */
    public function __construct(?\DateTime $start, ?\DateTime $end, ?\DateTime $resume)
    {
        $this->start  = $start;
        $this->end    = $end;
        $this->resume = $resume;
    }

    /**
     * @return \DateTime|null
     */
    public function getStart(): ?\DateTime
    {
        return $this->start;
    }

    /**
     * @return \DateTime|null
     */
    public function getEnd(): ?\DateTime
    {
        return $this->end;
    }
    /**
     * @return \DateTime|null
     */
    public function getResume(): ?\DateTime
    {
        return $this->resume;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            !empty($response[self::ATTRIBUTE_NAME_START])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_START])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_END])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_END])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_RESUME])
                ? new \DateTime($response[self::ATTRIBUTE_NAME_RESUME])
                : null
        );
    }
}
