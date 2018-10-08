<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class Monitor
 *
 * The monitors response objetc.
 *
 * @package SPie\WienerLinien\Response\DataObjects
 */
class Monitor implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_LOCATION_STOP          = 'locationStop';
    const ATTRIBUTE_NAME_LINES                  = 'lines';
    const ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES = 'refTrafficInfoNames';

    /**
     * @var LocationStop
     */
    private $locationStop;

    /**
     * @var Line[]
     */
    private $lines;

    /**
     * @var string[]
     */
    private $refTrafficInfoNames;

    /**
     * Monitor constructor.
     *
     * @param LocationStop $locationStop
     * @param Line[]       $lines
     * @param string[]     $refTrafficInfoNames
     */
    public function __construct(LocationStop $locationStop, array $lines, array $refTrafficInfoNames)
    {
        $this->locationStop        = $locationStop;
        $this->lines               = $lines;
        $this->refTrafficInfoNames = $refTrafficInfoNames;
    }

    /**
     * @return LocationStop
     */
    public function getLocationStop(): LocationStop
    {
        return $this->locationStop;
    }

    /**
     * @return Line[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @return string[]
     */
    public function getRefTrafficInfoNames(): array
    {
        return $this->refTrafficInfoNames;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self(
            !empty($response[self::ATTRIBUTE_NAME_LOCATION_STOP])
                ? LocationStop::fromResponse($response[self::ATTRIBUTE_NAME_LOCATION_STOP])
                : null,
            !empty($response[self::ATTRIBUTE_NAME_LINES])
                ? \array_map(
                    function (array $line) {
                        return Line::fromResponse($line);
                    },
                    $response[self::ATTRIBUTE_NAME_LINES]
                )
                : [],
            !empty($response[self::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES])
                ? \explode(',', $response[self::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES])
                : []
        );
    }

}
