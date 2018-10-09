<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Line
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
final class Line implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_TOWARDS            = 'towards';
    const ATTRIBUTE_NAME_LINE_ID            = 'lineId';
    const ATTRIBUTE_NAME_DEPARTURES         = 'departures';
    const ATTRIBUTE_NAME_DEPARTURE          = 'departure';
    const ATTRIBUTE_NAME_NAME               = 'name';
    const ATTRIBUTE_NAME_DIRECTION          = 'direction';
    const ATTRIBUTE_NAME_DIRECTION_ID       = 'richtungsId';
    const ATTRIBUTE_NAME_BARRIER_FREE       = 'barrierFree';
    const ATTRIBUTE_NAME_REALTIME_SUPPORTED = 'realtimeSupported';
    const ATTRIBUTE_NAME_TRAFFIC_JAM        = 'trafficjam';
    const ATTRIBUTE_NAME_TYPE               = 'type';

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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var int
     */
    private $directionId;

    /**
     * @var bool|null
     */
    private $barrierFree;

    /**
     * @var bool|null
     */
    private $realtimeSupported;

    /**
     * @var bool|null
     */
    private $trafficJam;

    /**
     * @var string
     */
    private $type;

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
        $this->towards = $towards;
        $this->lineId = $lineId;
        $this->departures = $departures;
        $this->name = $name;
        $this->direction = $direction;
        $this->directionId = $directionId;
        $this->barrierFree = $barrierFree;
        $this->realtimeSupported = $realtimeSupported;
        $this->trafficJam = $trafficJam;
        $this->type = $type;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getDirectionId(): int
    {
        return $this->directionId;
    }

    /**
     * @return bool|null
     */
    public function getBarrierFree(): ?bool
    {
        return $this->barrierFree;
    }

    /**
     * @return bool|null
     */
    public function getRealtimeSupported(): ?bool
    {
        return $this->realtimeSupported;
    }

    /**
     * @return bool|null
     */
    public function getTrafficJam(): ?bool
    {
        return $this->trafficJam;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
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
