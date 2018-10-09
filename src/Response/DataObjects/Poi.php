<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Poi
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
final class Poi implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_REF_POI_CATEGORY_ID = 'refPoiCategoryId';
    const ATTRIBUTE_NAME_NAME                = 'name';
    const ATTRIBUTE_NAME_START               = 'start';
    const ATTRIBUTE_NAME_END                 = 'end';
    const ATTRIBUTE_NAME_TITLE               = 'title';
    const ATTRIBUTE_NAME_SUBTITLE            = 'subtitle';
    const ATTRIBUTE_NAME_DESCRIPTION         = 'description';
    const ATTRIBUTE_NAME_RELATED_LINES       = 'relatedLines';
    const ATTRIBUTE_NAME_RELATED_STOPS       = 'relatedStops';
    const ATTRIBUTE_NAME_ATTRIBUTES          = 'attributes';

    /**
     * @var int
     */
    private $refPoiCategoryId;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var \DateTime|null
     */
    private $start;

    /**
     * @var \DateTime|null
     */
    private $end;

    /**
     * @var string
     */
    private $title;

    /**
     * @var null|string
     */
    private $subtitle;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var \string[]
     */
    private $relatedLines;

    /**
     * @var \string[]
     */
    private $relatedStops;

    /**
     * @var array
     */
    private $attributes;

    /**
     * Poi constructor.
     *
     * @param int            $refPoiCategoryId
     * @param string|null    $name
     * @param \DateTime|null $start
     * @param \DateTime|null $end
     * @param string         $title
     * @param null|string    $subtitle
     * @param string|null    $description
     * @param string[]       $relatedLines
     * @param string[]       $relatedStops
     * @param array          $attributes
     */
    public function __construct(
        int $refPoiCategoryId,
        ?string $name,
        ?\DateTime $start,
        ?\DateTime $end,
        string $title,
        ?string $subtitle,
        ?string $description,
        array $relatedLines,
        array $relatedStops,
        array $attributes
    )
    {
        $this->refPoiCategoryId = $refPoiCategoryId;
        $this->name             = $name;
        $this->start            = $start;
        $this->end              = $end;
        $this->title            = $title;
        $this->subtitle         = $subtitle;
        $this->description      = $description;
        $this->relatedLines     = $relatedLines;
        $this->relatedStops     = $relatedStops;
        $this->attributes       = $attributes;
    }

    /**
     * @return int
     */
    public function getRefPoiCategoryId(): int
    {
        return $this->refPoiCategoryId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return \string[]
     */
    public function getRelatedLines(): array
    {
        return $this->relatedLines;
    }

    /**
     * @return \string[]
     */
    public function getRelatedStops(): array
    {
        return $this->relatedStops;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
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
            $response[self::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_NAME] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_START])
                ? (new \DateTime())->setTimestamp(\substr($response[self::ATTRIBUTE_NAME_START], 0, -3))
                : null,
            !empty($response[self::ATTRIBUTE_NAME_END])
                ? (new \DateTime())->setTimestamp(\substr($response[self::ATTRIBUTE_NAME_END], 0, -3))
                : null,
            $response[self::ATTRIBUTE_NAME_TITLE] ?? null,
            $response[self::ATTRIBUTE_NAME_SUBTITLE] ?? null,
            $response[self::ATTRIBUTE_NAME_DESCRIPTION] ?? null,
            $response[self::ATTRIBUTE_NAME_RELATED_LINES] ?? [],
            $response[self::ATTRIBUTE_NAME_RELATED_STOPS] ?? [],
            $response[self::ATTRIBUTE_NAME_ATTRIBUTES] ?? []
        );
    }
}
