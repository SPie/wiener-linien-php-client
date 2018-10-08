<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Coordinates
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
class Coordinates implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_LATITUDE  = 0;
    const ATTRIBUTE_NAME_LONGITUDE = 1;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * Coordinates constructor.
     *
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        //TODO coordinate type to validate the format
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_LATITUDE] ?? null,
            $response[self::ATTRIBUTE_NAME_LONGITUDE] ?? null
        );
    }

}
