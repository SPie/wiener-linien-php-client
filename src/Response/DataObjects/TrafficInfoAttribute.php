<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class TrafficInfoAttribute
 *
 * @package SPie\WienerLinien\Response
 */
final class TrafficInfoAttribute implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_STATUS        = 'status';
    const ATTRIBUTE_NAME_STATION       = 'station';
    const ATTRIBUTE_NAME_LOCATION      = 'location';
    const ATTRIBUTE_NAME_REASON        = 'reason';
    const ATTRIBUTE_NAME_TOWARDS       = 'towards';
    const ATTRIBUTE_NAME_RELATED_LINES = 'relatedLines';
    const ATTRIBUTE_NAME_RELATED_STOPS = 'relatedStops';

    /**
     * @var null|string
     */
    private $status;

    /**
     * @var null|string
     */
    private $station;

    /**
     * @var null|string
     */
    private $location;

    /**
     * @var null|string
     */
    private $reason;

    /**
     * @var null|string
     */
    private $towards;

    /**
     * @var string[]
     */
    private $relatedLines;

    /**
     * @var string[]
     */
    private $relatedStops;

    /**
     * TrafficInfoAttribute constructor.
     *
     * @param null|string $status
     * @param null|string $station
     * @param null|string $location
     * @param null|string $reason
     * @param null|string $towards
     * @param string[]    $relatedLines
     * @param string[]    $relatedStops
     */
    public function __construct(
        ?string $status,
        ?string $station,
        ?string $location,
        ?string $reason,
        ?string $towards,
        array $relatedLines,
        array $relatedStops
    )
    {
        $this->status       = $status;
        $this->station      = $station;
        $this->location     = $location;
        $this->reason       = $reason;
        $this->towards      = $towards;
        $this->relatedLines = $relatedLines;
        $this->relatedStops = $relatedStops;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getStation(): ?string
    {
        return $this->station;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @return string|null
     */
    public function getTowards(): ?string
    {
        return $this->towards;
    }

    /**
     * @return string[]
     */
    public function getRelatedLines(): array
    {
        return $this->relatedLines;
    }

    /**
     * @return string[]
     */
    public function getRelatedStops(): array
    {
        return $this->relatedStops;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_STATUS] ?? null,
            $response[self::ATTRIBUTE_NAME_STATION] ?? null,
            $response[self::ATTRIBUTE_NAME_LOCATION] ?? null,
            $response[self::ATTRIBUTE_NAME_REASON] ?? null,
            $response[self::ATTRIBUTE_NAME_TOWARDS] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_RELATED_LINES])
                ? \explode(',', $response[self::ATTRIBUTE_NAME_RELATED_LINES])
                : [],
            !empty($response[self::ATTRIBUTE_NAME_RELATED_STOPS])
                ? \explode(',', $response[self::ATTRIBUTE_NAME_RELATED_STOPS])
                : []
        );
    }
}
