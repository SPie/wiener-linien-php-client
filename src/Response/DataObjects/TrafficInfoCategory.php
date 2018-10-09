<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class TrafficInfoCategory
 *
 * @package SPie\WienerLinien\Response
 */
final class TrafficInfoCategory implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_ID                                 = 'id';
    const ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID = 'refTrafficInfoCategoryGroupId';
    const ATTRIBUTE_NAME_NAME                               = 'name';
    const ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             = 'trafficInfoNameList';
    const ATTRIBUTE_NAME_TITLE                              = 'title';

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $refTrafficInfoCategoryGroupId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $trafficInfoNameList;

    /**
     * @var string
     */
    private $title;

    /**
     * TrafficInfoCategory constructor.
     *
     * @param int      $id
     * @param int      $refTrafficInfoCategoryGroupId
     * @param string   $name
     * @param string[] $trafficInfoNameList
     * @param string   $title
     */
    public function __construct(
        int $id,
        int $refTrafficInfoCategoryGroupId,
        string $name,
        array $trafficInfoNameList,
        string $title
    )
    {
        $this->id                            = $id;
        $this->refTrafficInfoCategoryGroupId = $refTrafficInfoCategoryGroupId;
        $this->name                          = $name;
        $this->trafficInfoNameList           = $trafficInfoNameList;
        $this->title                         = $title;
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
    public function getRefTrafficInfoCategoryGroupId(): int
    {
        return $this->refTrafficInfoCategoryGroupId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function getTrafficInfoNameList(): array
    {
        return $this->trafficInfoNameList;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
            $response[self::ATTRIBUTE_NAME_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID] ?? null,
            $response[self::ATTRIBUTE_NAME_NAME] ?? null,
            !empty($response[self::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST])
                ? \explode(',', $response[self::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST])
                : [],
            $response[self::ATTRIBUTE_NAME_TITLE] ?? null
        );
    }
}
