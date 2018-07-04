<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class PoiCategory
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
class PoiCategory implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_NAME                      = 'name';
    const ATTRIBUTE_NAME_TITLE                     = 'title';
    const ATTRIBUTE_NAME_ID                        = 'id';
    const ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID = 'refPoiCategoryGroupId';

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $refPoiCategoryGroupId;

    /**
     * PoiCategory constructor.
     *
     * @param string|null $name
     * @param string      $title
     * @param int         $id
     * @param int         $refPoiCategoryGroupId
     */
    public function __construct(?string $name, string $title, int $id, int $refPoiCategoryGroupId)
    {
        $this->name                  = $name;
        $this->title                 = $title;
        $this->id                    = $id;
        $this->refPoiCategoryGroupId = $refPoiCategoryGroupId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRefPoiCategoryGroupId(): int
    {
        return $this->refPoiCategoryGroupId;
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
            $response[self::ATTRIBUTE_NAME_TITLE] ?? null,
            $response[self::ATTRIBUTE_NAME_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID] ?? null
        );
    }
}