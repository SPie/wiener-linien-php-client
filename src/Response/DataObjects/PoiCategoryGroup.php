<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class PoiCategoryGroup
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
class PoiCategoryGroup implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_NAME  = 'name';
    const ATTRIBUTE_NAME_ID    = 'id';
    const ATTRIBUTE_NAME_TITLE = 'title';

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $title;

    /**
     * PoiCategoryGroup constructor.
     *
     * @param string|null $name
     * @param int         $id
     * @param null|string $title
     */
    public function __construct(?string $name, int $id, ?string $title)
    {
        $this->name  = $name;
        $this->id    = $id;
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
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
            $response[self::ATTRIBUTE_NAME_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_TITLE] ?? null
        );
    }
}