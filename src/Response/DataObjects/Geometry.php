<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Geometry
 *
 * @package SPie\WienerLinien\Response
 */
class Geometry implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_TYPE        = 'type';
    const ATTRIBUTE_NAME_COORDINATES = 'coordinates';

    /**
     * @var string
     */
    private $type;

    /**
     * @var Coordinates
     */
    private $coordinates;

    /**
     * Geometry constructor.
     *
     * @param string      $type
     * @param Coordinates $coordinates
     */
    public function __construct(string $type, Coordinates $coordinates)
    {
        $this->type        = $type;
        $this->coordinates = $coordinates;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_TYPE] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_COORDINATES])
                ? Coordinates::fromResponse($response[self::ATTRIBUTE_NAME_COORDINATES])
                : null
        );
    }
}