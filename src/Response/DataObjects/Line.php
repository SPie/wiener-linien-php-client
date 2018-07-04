<?php

namespace SPie\WienerLinien\Response\DataObjects;

/**
 * Class Line
 *
 * @package SPie\WienerLinien\Response
 */
class Line extends Vehicle
{

    const ATTRIBUTE_NAME_TOWARDS            = 'towards';
    const ATTRIBUTE_NAME_LINE_ID            = 'lineId';
    const ATTRIBUTE_NAME_DEPARTURES         = 'departures';
    const ATTRIBUTE_NAME_DEPARTURE          = 'departure';

    /**
     * @var string
     */
    private $towards;

    /**
     * @var int|null
     */
    private $lineId;

    /**
     * @var Departure[]
     */
    private $departures;

    /**
     * Line constructor.
     *
     * @param string      $name
     * @param string      $towards
     * @param string      $direction
     * @param int         $directionId
     * @param bool|null   $barrierFree
     * @param bool|null   $realtimeSupported
     * @param bool|null   $trafficJam
     * @param string      $type
     * @param int|null    $lineId
     * @param Departure[] $departures
     */
    public function __construct(
        string $name,
        string $towards,
        string $direction,
        int $directionId,
        ?bool $barrierFree,
        ?bool $realtimeSupported,
        ?bool $trafficJam,
        string $type,
        ?int $lineId,
        array $departures
    )
    {
        $this->towards    = $towards;
        $this->lineId     = $lineId;
        $this->departures = $departures;

        parent::__construct($name, $direction, $directionId, $barrierFree, $realtimeSupported, $trafficJam, $type);
    }

    /**
     * @return string
     */
    public function getTowards(): string
    {
        return $this->towards;
    }

    /**
     * @return int|null
     */
    public function getLineId(): ?int
    {
        return $this->lineId;
    }

    /**
     * @return Departure[]
     */
    public function getDepartures(): array
    {
        return $this->departures;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_NAME] ?? null,
            $response[self::ATTRIBUTE_NAME_TOWARDS] ?? null,
            $response[self::ATTRIBUTE_NAME_DIRECTION] ?? null,
            $response[self::ATTRIBUTE_NAME_DIRECTION_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_BARRIER_FREE] ?? null,
            $response[self::ATTRIBUTE_NAME_REALTIME_SUPPORTED] ?? null,
            $response[self::ATTRIBUTE_NAME_TRAFFIC_JAM] ?? null,
            $response[self::ATTRIBUTE_NAME_TYPE] ?? null,
            $response[self::ATTRIBUTE_NAME_LINE_ID] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_DEPARTURES][self::ATTRIBUTE_NAME_DEPARTURE])
                 ? \array_map(
                     function (array $departure) {
                         return Departure::fromResponse($departure);
                     },
                    $response[self::ATTRIBUTE_NAME_DEPARTURES][self::ATTRIBUTE_NAME_DEPARTURE]
                )
                : []
        );
    }
}