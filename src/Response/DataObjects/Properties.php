<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Properties
 *
 * @package SPie\WienerLinien\Response
 */
class Properties implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_NAME            = 'name';
    const ATTRIBUTE_NAME_TITLE           = 'title';
    const ATTRIBUTE_NAME_MUNICIPALITY    = 'municipality';
    const ATTRIBUTE_NAME_MUNICIPALITY_ID = 'municipalityId';
    const ATTRIBUTE_NAME_TYPE            = 'type';
    const ATTRIBUTE_NAME_COORDINATE_NAME = 'coordName';
    const ATTRIBUTE_NAME_GATE            = 'gate';
    const ATTRIBUTE_NAME_ATTRIBUTES      = 'attributes';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $municipality;

    /**
     * @var int
     */
    private $municipalityId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $coordinateName;

    /**
     * @var null|string
     */
    private $gate;

    /**
     * @var PropertiesAttributes
     */
    private $attributes;

    /**
     * Properties constructor.
     *
     * @param string               $name
     * @param string               $title
     * @param string               $municipality
     * @param int                  $municipalityId
     * @param string               $type
     * @param string               $coordinateName
     * @param null|string          $gate
     * @param PropertiesAttributes $attributes
     */
    public function __construct(
        string $name,
        string $title,
        string $municipality,
        int $municipalityId,
        string $type,
        string $coordinateName,
        ?string $gate,
        PropertiesAttributes $attributes
    )
    {
        $this->name           = $name;
        $this->title          = $title;
        $this->municipality   = $municipality;
        $this->municipalityId = $municipalityId;
        $this->type           = $type;
        $this->coordinateName = $coordinateName;
        $this->gate           = $gate;
        $this->attributes     = $attributes;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMunicipality(): string
    {
        return $this->municipality;
    }

    /**
     * @return int
     */
    public function getMunicipalityId(): int
    {
        return $this->municipalityId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCoordinateName(): string
    {
        return $this->coordinateName;
    }

    /**
     * @return string|null
     */
    public function getGate(): ?string
    {
        return $this->gate;
    }

    /**
     * @return PropertiesAttributes
     */
    public function getAttributes(): PropertiesAttributes
    {
        return $this->attributes;
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
            $response[self::ATTRIBUTE_NAME_TYPE] ?? null,
            $response[self::ATTRIBUTE_NAME_MUNICIPALITY] ?? null,
            $response[self::ATTRIBUTE_NAME_MUNICIPALITY_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_TYPE] ?? null,
            $response[self::ATTRIBUTE_NAME_COORDINATE_NAME] ?? null,
            $response[self::ATTRIBUTE_NAME_GATE] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_ATTRIBUTES])
                ? PropertiesAttributes::fromResponse($response[self::ATTRIBUTE_NAME_ATTRIBUTES])
                : null
        );
    }
}