<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class TrafficInfo
 *
 * @package SPie\WienerLinien\Response
 */
class TrafficInfo implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_ID = 'refTrafficInfoCategoryId';
    const ATTRIBUTE_NAME_NAME                         = 'name';
    const ATTRIBUTE_NAME_PRIORITY                     = 'priority';
    const ATTRIBUTE_NAME_OWNER                        = 'owner';
    const ATTRIBUTE_NAME_TITLE                        = 'title';
    const ATTRIBUTE_NAME_DESCRIPTION                  = 'description';
    const ATTRIBUTE_NAME_RELATED_LINES                = 'relatedLines';
    const ATTRIBUTE_NAME_RELATED_STOPS                = 'relatedStops';
    const ATTRIBUTE_NAME_TIME                         = 'time';
    const ATTRIBUTE_NAME_ATTRIBUTES                   = 'attributes';

    /**
     * @var int
     */
    private $refTrafficInfoCategoryId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string
     */
    private $priority;

    /**
     * @var null|string
     */
    private $owner;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string[]
     */
    private $relatedLines;

    /**
     * @var string[]
     */
    private $relatedStops;

    /**
     * @var null|TrafficTime
     */
    private $time;

    /**
     * @var TrafficInfoAttribute[]
     */
    private $attributes;

    /**
     * TrafficInfo constructor.
     *
     * @param int                    $refTrafficInfoCategoryId
     * @param string                 $name
     * @param null|string            $priority
     * @param null|string            $owner
     * @param string                 $title
     * @param string                 $description
     * @param string[]               $relatedLines
     * @param string[]               $relatedStops
     * @param null|TrafficTime       $time
     * @param TrafficInfoAttribute[] $attributes
     */
    public function __construct(
        int $refTrafficInfoCategoryId,
        string $name,
        ?string $priority,
        ?string $owner,
        string $title,
        string $description,
        array $relatedLines,
        array $relatedStops,
        ?TrafficTime $time,
        array $attributes
    )
    {
        $this->refTrafficInfoCategoryId = $refTrafficInfoCategoryId;
        $this->name                     = $name;
        $this->priority                 = $priority;
        $this->owner                    = $owner;
        $this->title                    = $title;
        $this->description              = $description;
        $this->relatedLines             = $relatedLines;
        $this->relatedStops             = $relatedStops;
        $this->time                     = $time;
        $this->attributes               = $attributes;
    }

    /**
     * @return int
     */
    public function getRefTrafficInfoCategoryId(): int
    {
        return $this->refTrafficInfoCategoryId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * @return string|null
     */
    public function getOwner(): ?string
    {
        return $this->owner;
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
    public function getDescription(): string
    {
        return $this->description;
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
     * @return TrafficTime|null
     */
    public function getTime(): ?TrafficTime
    {
        return $this->time;
    }

    /**
     * @return TrafficInfoAttribute[]
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
            $response[self::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_NAME] ?? null,
            $response[self::ATTRIBUTE_NAME_PRIORITY] ?? null,
            $response[self::ATTRIBUTE_NAME_OWNER] ?? null,
            $response[self::ATTRIBUTE_NAME_TITLE] ?? null,
            $response[self::ATTRIBUTE_NAME_DESCRIPTION] ?? null,
            $response[self::ATTRIBUTE_NAME_RELATED_LINES] ?? [],
            $response[self::ATTRIBUTE_NAME_RELATED_STOPS] ?? [],
            !empty($response[self::ATTRIBUTE_NAME_TIME])
                ? TrafficTime::fromResponse($response[self::ATTRIBUTE_NAME_TIME])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_ATTRIBUTES])
                ? \array_map(
                    function (array $attribute) {
                        return TrafficInfoAttribute::fromResponse($attribute);
                    },
                    $response[self::ATTRIBUTE_NAME_ATTRIBUTES]
                )
                : []
        );
    }
}