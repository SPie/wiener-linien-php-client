<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Departure
 *
 * @package SPie\WienerLinien\Response
 */
class Departure implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_DEPARTURE_TIME = 'departureTime';
    const ATTRIBUTE_NAME_VEHICLE        = 'vehicle';

    /**
     * @var DepartureTime
     */
    private $departureTime;

    /**
     * @var Vehicle|null
     */
    private $vehicle;

    /**
     * Departure constructor.
     *
     * @param DepartureTime $departureTime
     * @param null|Vehicle  $vehicle
     */
    public function __construct(DepartureTime $departureTime, ?Vehicle $vehicle)
    {
        $this->departureTime = $departureTime;
        $this->vehicle       = $vehicle;
    }

    /**
     * @return DepartureTime
     */
    public function getDepartureTime(): DepartureTime
    {
        return $this->departureTime;
    }

    /**
     * @return Vehicle|null
     */
    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            !empty($response[self::ATTRIBUTE_NAME_DEPARTURE_TIME])
                ? DepartureTime::fromResponse($response[self::ATTRIBUTE_NAME_DEPARTURE_TIME])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_VEHICLE])
                ? Vehicle::fromResponse($response[self::ATTRIBUTE_NAME_VEHICLE])
                : null
        );
    }
}