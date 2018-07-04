<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class LocationStop
 *
 * Location stop response object.
 *
 * @package SPie\WienerLinien\Response
 */
class LocationStop implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_TYPE       = 'type';
    const ATTRIBUTE_NAME_GEOMETRY   = 'geometry';
    const ATTRIBUTE_NAME_PROPERTIES = 'properties';

    /**
     * @var string
     */
    private $type;

    /**
     * @var Geometry
     */
    private $geometry;

    /**
     * @var Properties
     */
    private $properties;

    /**
     * LocationStop constructor.
     *
     * @param string     $type
     * @param Geometry   $geometry
     * @param Properties $properties
     */
    public function __construct(string $type, Geometry $geometry, Properties $properties)
    {
        $this->type       = $type;
        $this->geometry   = $geometry;
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Geometry
     */
    public function getGeometry(): Geometry
    {
        return $this->geometry;
    }

    /**
     * @return Properties
     */
    public function getProperties(): Properties
    {
        return $this->properties;
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
            !empty($response[self::ATTRIBUTE_NAME_GEOMETRY])
                ? Geometry::fromResponse($response[self::ATTRIBUTE_NAME_GEOMETRY])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_PROPERTIES])
                ? Properties::fromResponse($response[self::ATTRIBUTE_NAME_PROPERTIES])
                : null
        );
    }

}