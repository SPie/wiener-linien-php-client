<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class TrafficInfoCategoryGroup
 *
 * @package SPie\WienerLinien\Response
 */
final class TrafficInfoCategoryGroup implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_ID   = 'id';
    const ATTRIBUTE_NAME_NAME = 'name';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * TrafficInfoCategoryGroup constructor.
     *
     * @param int    $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            $response[self::ATTRIBUTE_NAME_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_NAME] ?? null
        );
    }
}
