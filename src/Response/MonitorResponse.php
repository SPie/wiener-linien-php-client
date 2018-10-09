<?php

namespace SPie\WienerLinien\Response;

use SPie\WienerLinien\Response\DataObjects\Monitor;
use SPie\WienerLinien\Response\DataObjects\TrafficInfo;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategory;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategoryGroup;

/**
 * Class MonitorResponse
 *
 * @package SPie\WienerLinien\Response
 */
final class MonitorResponse implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_MONITORS                     = 'monitors';
    const ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS = 'trafficInfoCategoryGroups';
    const ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      = 'trafficInfoCategories';
    const ATTRIBUTE_NAME_TRAFFIC_INFOS                = 'trafficInfos';
    const ATTRIBUTE_NAME_MESSAGE                      = 'message';

    /**
     * @var Monitor[]
     */
    private $monitors;

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
     * @var ResponseMessage
     */
    private $message;

    /**
     * MonitorResponse constructor.
     *
     * @param Monitor[]                  $monitors
     * @param TrafficInfoCategoryGroup[] $trafficInfoCategoryGroups
     * @param TrafficInfoCategory[]      $trafficInfoCategories
     * @param TrafficInfo[]              $trafficInfos
     * @param ResponseMessage            $message
     */
    public function __construct(
        array $monitors,
        array $trafficInfoCategoryGroups,
        array $trafficInfoCategories,
        array $trafficInfos,
        ResponseMessage $message
    )
    {
        $this->monitors                  = $monitors;
        $this->trafficInfoCategoryGroups = $trafficInfoCategoryGroups;
        $this->trafficInfoCategories     = $trafficInfoCategories;
        $this->trafficInfos              = $trafficInfos;
        $this->message                   = $message;
    }

    /**
     * @return Monitor[]
     */
    public function getMonitors(): array
    {
        return $this->monitors;
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
     * @return ResponseMessage
     */
    public function getMessage(): ResponseMessage
    {
        return $this->message;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        $data = $response[self::ATTRIBUTE_NAME_DATA];

        return new self(
            !empty($data[self::ATTRIBUTE_NAME_MONITORS])
                ? \array_map(
                    function (array $monitor) {
                        return Monitor::fromResponse($monitor);
                    },
                $data[self::ATTRIBUTE_NAME_MONITORS]
                )
                : [],
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
                : [],
            !empty($response[self::ATTRIBUTE_NAME_MESSAGE])
                ? ResponseMessage::fromResponse($response[self::ATTRIBUTE_NAME_MESSAGE])
                : null
        );
    }

}
