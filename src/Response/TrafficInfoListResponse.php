<?php

namespace SPie\WienerLinien\Response;

use SPie\WienerLinien\Response\DataObjects\TrafficInfo;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategory;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategoryGroup;

/**
 * Class TrafficInfoListResponse
 *
 * @package SPie\WienerLinien\Response
 */
class TrafficInfoListResponse extends Response
{

    const ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS = 'trafficInfoCategoryGroups';
    const ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      = 'trafficInfoCategories';
    const ATTRIBUTE_NAME_TRAFFIC_INFOS                = 'trafficInfos';


    /**
     * @var TrafficInfoCategoryGroup[]
     */
    private $trafficInfoCategoryGroups;

    /**
     * @var TrafficInfoCategory[]
     */
    private $trafficInfoCategories;

    /**
     * @var TrafficInfo[]
     */
    private $trafficInfos;

    /**
     * TrafficInfoListResponse constructor.
     *
     * @param TrafficInfoCategoryGroup[] $trafficInfoCategoryGroups
     * @param TrafficInfoCategory[]      $trafficInfoCategories
     * @param TrafficInfo[]              $trafficInfos
     */
    public function __construct(
        array $trafficInfoCategoryGroups,
        array $trafficInfoCategories,
        array $trafficInfos
    )
    {
        $this->trafficInfoCategoryGroups = $trafficInfoCategoryGroups;
        $this->trafficInfoCategories     = $trafficInfoCategories;
        $this->trafficInfos              = $trafficInfos;
    }

    /**
     * @return TrafficInfoCategoryGroup[]
     */
    public function getTrafficInfoCategoryGroups(): array
    {
        return $this->trafficInfoCategoryGroups;
    }

    /**
     * @return TrafficInfoCategory[]
     */
    public function getTrafficInfoCategories(): array
    {
        return $this->trafficInfoCategories;
    }

    /**
     * @return TrafficInfo[]
     */
    public function getTrafficInfos(): array
    {
        return $this->trafficInfos;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        $data = $response[self::ATTRIBUTE_NAME_DATA] ?? [];

        return new self(
            !empty($data[self::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS])
                ? \array_map(
                    function (array $trafficInfoCategoryGroup) {
                        return TrafficInfoCategoryGroup::fromResponse($trafficInfoCategoryGroup);
                    },
                    $data[self::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS]
                )
                : [],
            !empty($data[self::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES])
                ? \array_map(
                    function (array $trafficInfoCategory) {
                        return TrafficInfoCategory::fromResponse($trafficInfoCategory);
                    },
                    $data[self::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES]
                )
                : [],
            !empty($data[self::ATTRIBUTE_NAME_TRAFFIC_INFOS])
                ? \array_map(
                    function (array $trafficInfo) {
                        return TrafficInfo::fromResponse($trafficInfo);
                    },
                    $data[self::ATTRIBUTE_NAME_TRAFFIC_INFOS]
                )
                : []
        );
    }
}