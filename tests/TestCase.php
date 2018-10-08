<?php

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase as BaseTestCase;
use SPie\WienerLinien\Response\DataObjects\Coordinates;
use SPie\WienerLinien\Response\DataObjects\Departure;
use SPie\WienerLinien\Response\DataObjects\DepartureTime;
use SPie\WienerLinien\Response\DataObjects\Geometry;
use SPie\WienerLinien\Response\DataObjects\Line;
use SPie\WienerLinien\Response\DataObjects\LocationStop;
use SPie\WienerLinien\Response\DataObjects\Monitor;
use SPie\WienerLinien\Response\DataObjects\Poi;
use SPie\WienerLinien\Response\DataObjects\PoiCategory;
use SPie\WienerLinien\Response\DataObjects\PoiCategoryGroup;
use SPie\WienerLinien\Response\DataObjects\Properties;
use SPie\WienerLinien\Response\DataObjects\PropertiesAttributes;
use SPie\WienerLinien\Response\DataObjects\TrafficInfo;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoAttribute;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategory;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategoryGroup;
use SPie\WienerLinien\Response\DataObjects\TrafficTime;
use SPie\WienerLinien\Response\DataObjects\Vehicle;
use SPie\WienerLinien\Response\ResponseMessage;

/**
 * Class TestCase
 */
class TestCase extends BaseTestCase
{

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @return Generator
     */
    protected function getFaker(): Generator
    {
        if (!isset($this->faker)) {
            $this->faker = Factory::create();
        }

        return $this->faker;
    }

    //region DataObjects

    /**
     * @return Coordinates
     */
    protected function createCoordinates(): Coordinates
    {
        return new Coordinates($this->getFaker()->randomFloat(), $this->getFaker()->randomFloat());
    }

    /**
     * @return array
     */
    protected function createCoordinatesArray(): array
    {
        return [
            Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->randomFloat(),
            Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->randomFloat(),
        ];
    }

    /**
     * @return Departure
     */
    protected function createDeparture(): Departure
    {
        return new Departure(
            $this->createDepartureTime(),
            $this->createVehicle()
        );
    }

    /**
     * @return array
     */
    protected function createDepartureArray(): array
    {
        return [
            Departure::ATTRIBUTE_NAME_DEPARTURE_TIME => $this->createDepartureTimeArray(),
            Departure::ATTRIBUTE_NAME_VEHICLE        => $this->createVehicleArray(),
        ];
    }

    /**
     * @return DepartureTime
     */
    protected function createDepartureTime(): DepartureTime
    {
        return new DepartureTime(
            $this->getFaker()->dateTime,
            $this->getFaker()->dateTime,
            $this->getFaker()->numberBetween()
        );
    }

    /**
     * @return array
     */
    protected function createDepartureTimeArray(): array
    {
        return [
            DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->dateTime->format(
                'Y-m-d H:i:s'
            ),
            DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format(
                'Y-m-d H:i:s'
            ),
            DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->numberBetween(),
        ];
    }

    /**
     * @return Geometry
     */
    protected function createGeometry(): Geometry
    {
        return new Geometry(
            $this->getFaker()->uuid,
            $this->createCoordinates()
        );
    }

    /**
     * @return array
     */
    protected function createGeometryArray(): array
    {
        return [
            Geometry::ATTRIBUTE_NAME_TYPE        => $this->getFaker()->uuid,
            Geometry::ATTRIBUTE_NAME_COORDINATES => $this->createCoordinatesArray(),
        ];
    }

    /**
     * @return Line
     */
    protected function createLine(): Line
    {
        return new Line(
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->boolean,
            $this->getFaker()->boolean,
            $this->getFaker()->boolean,
            $this->getFaker()->word,
            $this->getFaker()->numberBetween(),
            [
                $this->createDeparture(),
            ]
        );
    }

    /**
     * @return array
     */
    protected function createLineArray(): array
    {
        return [
            Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
            Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
            Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
            Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
            Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
            Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
            Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
            Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->word,
            Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
            Line::ATTRIBUTE_NAME_DEPARTURES         => [
                Line::ATTRIBUTE_NAME_DEPARTURE => [
                    $this->createDepartureArray()
                ]
            ],
        ];
    }

    /**
     * @return LocationStop
     */
    protected function createLocationStop(): LocationStop
    {
        return new LocationStop(
            $this->getFaker()->uuid,
            $this->createGeometry(),
            $this->createProperties()
        );
    }

    /**
     * @return array
     */
    protected function createLocationStopArray(): array
    {
        return [
            LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->uuid,
            LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->createGeometryArray(),
            LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
        ];
    }

    /**
     * @return Monitor
     */
    protected function createMonitor(): Monitor
    {
        return new Monitor(
            $this->createLocationStop(),
            [
                $this->createLine(),
            ],
            [
                $this->getFaker()->uuid,
            ]
        );
    }

    /**
     * @return array
     */
    protected function createMonitorArray(): array
    {
        return [
            Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
            Monitor::ATTRIBUTE_NAME_LINES => [
                $this->createLineArray(),
            ],
            Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                . ',' . $this->getFaker()->uuid,
        ];
    }

    /**
     * @return Poi
     */
    protected function createPoi(): Poi
    {
        return new Poi(
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid,
            $this->getFaker()->dateTime,
            $this->getFaker()->dateTime,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            [
                $this->getFaker()->uuid,
            ],
            [
                $this->getFaker()->uuid,
            ],
            [
                $this->getFaker()->uuid,
            ]
        );
    }

    /**
     * @return array
     */
    protected function createPoiArray(): array
    {
        return [
            Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
            Poi::ATTRIBUTE_NAME_NAME                => $this->getFaker()->uuid,
            Poi::ATTRIBUTE_NAME_START               => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
            Poi::ATTRIBUTE_NAME_END                 => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
            Poi::ATTRIBUTE_NAME_TITLE               => $this->getFaker()->uuid,
            Poi::ATTRIBUTE_NAME_SUBTITLE            => $this->getFaker()->uuid,
            Poi::ATTRIBUTE_NAME_DESCRIPTION         => $this->getFaker()->uuid,
            Poi::ATTRIBUTE_NAME_RELATED_LINES       => [
                $this->getFaker()->uuid,
            ],
            Poi::ATTRIBUTE_NAME_RELATED_STOPS       => [
                $this->getFaker()->uuid,
            ],
            Poi::ATTRIBUTE_NAME_ATTRIBUTES          => [
                $this->getFaker()->uuid,
            ],
        ];
    }

    /**
     * @return PoiCategory
     */
    protected function createPoiCategory(): PoiCategory
    {
        return new PoiCategory(
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->numberBetween()
        );
    }

    /**
     * @return array
     */
    protected function createPoiCategoryArray(): array
    {
        return [
            PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
            PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
            PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
            PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
        ];
    }

    /**
     * @return PoiCategoryGroup
     */
    protected function createPoiCategoryGroup(): PoiCategoryGroup
    {
        return new PoiCategoryGroup(
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid
        );
    }

    /**
     * @return array
     */
    protected function createPoiCategoryGroupArray(): array
    {
        return [
            PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->uuid,
            PoiCategoryGroup::ATTRIBUTE_NAME_ID    => $this->getFaker()->numberBetween(),
            PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
        ];
    }

    /**
     * @return Properties
     */
    protected function createProperties(): Properties
    {
        return new Properties(
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->createPropertyAttributes()
        );
    }

    /**
     * @return array
     */
    protected function createPropertiesArray(): array
    {
        return [
            Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
            Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
            Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
        ];
    }

    /**
     * @return PropertiesAttributes
     */
    protected function createPropertyAttributes(): PropertiesAttributes
    {
        return new PropertiesAttributes(
            $this->getFaker()->numberBetween()
        );
    }

    /**
     * @return array
     */
    protected function createPropertyAttributesArray(): array
    {
        return [
            PropertiesAttributes::ATTRIBUTE_NAME_RBL_NUMBER => $this->getFaker()->numberBetween(),
        ];
    }

    /**
     * @return ResponseMessage
     */
    protected function createResponseMessage(): ResponseMessage
    {
        return new ResponseMessage(
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->dateTime
        );
    }

    /**
     * @return array
     */
    protected function createResponseMessageArray(): array
    {
        return [
            ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
            ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
            ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @return TrafficInfo
     */
    protected function createTrafficInfo(): TrafficInfo
    {
        return new TrafficInfo(
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            [
                $this->getFaker()->uuid,
            ],
            [
                $this->getFaker()->uuid,
            ],
            $this->createTrafficTime(),
            [
                $this->createTrafficInfoAttribute(),
            ]
        );
    }

    /**
     * @return array
     */
    protected function createTrafficInfoArray(): array
    {
        return [
            TrafficInfo::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_ID => $this->getFaker()->numberBetween(),
            TrafficInfo::ATTRIBUTE_NAME_NAME                         => $this->getFaker()->uuid,
            TrafficInfo::ATTRIBUTE_NAME_PRIORITY                     => $this->getFaker()->uuid,
            TrafficInfo::ATTRIBUTE_NAME_OWNER                        => $this->getFaker()->uuid,
            TrafficInfo::ATTRIBUTE_NAME_TITLE                        => $this->getFaker()->uuid,
            TrafficInfo::ATTRIBUTE_NAME_DESCRIPTION                  => $this->getFaker()->uuid,
            TrafficInfo::ATTRIBUTE_NAME_RELATED_LINES                => [
                $this->getFaker()->uuid,
            ],
            TrafficInfo::ATTRIBUTE_NAME_RELATED_STOPS                => [
                $this->getFaker()->uuid,
            ],
            TrafficInfo::ATTRIBUTE_NAME_TIME                         => $this->createTrafficTimeArray(),
            TrafficInfo::ATTRIBUTE_NAME_ATTRIBUTES                   => [
                $this->createTrafficInfoAttributeArray(),
            ],
        ];
    }

    /**
     * @return TrafficInfoAttribute
     */
    protected function createTrafficInfoAttribute(): TrafficInfoAttribute
    {
        return new TrafficInfoAttribute(
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            [
                $this->getFaker()->uuid
            ],
            [
                $this->getFaker()->uuid
            ]
        );
    }

    /**
     * @return array
     */
    protected function createTrafficInfoAttributeArray(): array
    {
        return [
            TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS => $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_STATION => $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION => $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_REASON => $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS => $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                . ',' . $this->getFaker()->uuid,
            TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                . ',' . $this->getFaker()->uuid,
        ];
    }

    /**
     * @return TrafficInfoCategory
     */
    protected function createTrafficInfoCategory(): TrafficInfoCategory
    {
        return new TrafficInfoCategory(
            $this->getFaker()->numberBetween(),
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid,
            [
                $this->getFaker()->uuid,
            ],
            $this->getFaker()->uuid
        );
    }

    /**
     * @return array
     */
    protected function createTrafficInfoCategoryArray(): array
    {
        return [
            TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
            TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
            TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                . ',' . $this->getFaker()->uuid,
            TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
        ];
    }

    /**
     * @return TrafficInfoCategoryGroup
     */
    protected function createTrafficInfoCategoryGroup(): TrafficInfoCategoryGroup
    {
        return new TrafficInfoCategoryGroup(
            $this->getFaker()->numberBetween(),
            $this->getFaker()->uuid
        );
    }

    /**
     * @return array
     */
    protected function createTrafficInfoCategoryGroupArray(): array
    {
        return [
            TrafficInfoCategoryGroup::ATTRIBUTE_NAME_ID   => $this->getFaker()->numberBetween(),
            TrafficInfoCategoryGroup::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
        ];
    }

    /**
     * @return TrafficTime
     */
    protected function createTrafficTime(): TrafficTime
    {
        return new TrafficTime(
            $this->getFaker()->dateTime,
            $this->getFaker()->dateTime,
            $this->getFaker()->dateTime
        );
    }

    /**
     * @return array
     */
    protected function createTrafficTimeArray(): array
    {
        return [
            TrafficTime::ATTRIBUTE_NAME_START  => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            TrafficTime::ATTRIBUTE_NAME_END    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            TrafficTime::ATTRIBUTE_NAME_RESUME => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @return Vehicle
     */
    protected function createVehicle(): Vehicle
    {
        return new Vehicle(
            $this->getFaker()->uuid,
            $this->getFaker()->uuid,
            $this->getFaker()->numberBetween(),
            $this->getFaker()->boolean,
            $this->getFaker()->boolean,
            $this->getFaker()->boolean,
            $this->getFaker()->uuid
        );
    }

    /**
     * @return array
     */
    protected function createVehicleArray(): array
    {
        return [
            Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
            Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
            Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
            Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
            Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
            Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
            Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
        ];
    }

    //endregion
}
