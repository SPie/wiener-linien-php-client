<?php

use SPie\WienerLinien\Response\DataObjects\Departure;
use SPie\WienerLinien\Response\DataObjects\DepartureTime;
use SPie\WienerLinien\Response\DataObjects\Vehicle;

/**
 * Class DepartureTest
 */
class DepartureTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $departure = new Departure(
            $this->createDepartureTime(),
            $this->createVehicle()
        );

        $this->assertInstanceOf(Departure::class, $departure);
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $departure = new Departure(
            $this->createDepartureTime(),
            null
        );

        $this->assertInstanceOf(Departure::class, $departure);
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //invalid departure time
        try {
            new Departure(
                $this->getFaker()->uuid,
                $this->createVehicle()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty departure time
        try {
            new Departure(
                null,
                $this->createVehicle()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid vehicle
        try {
            new Departure(
                $this->createDepartureTime(),
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     */
    public function testFromResponse(): void
    {
        $this->assertInstanceOf(
            Departure::class,
            Departure::fromResponse([
                    Departure::ATTRIBUTE_NAME_DEPARTURE_TIME => $this->createDepartureTimeArray(),
                    Departure::ATTRIBUTE_NAME_VEHICLE        => $this->createVehicleArray(),
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty departure time
        try {
            Departure::fromResponse([
                    Departure::ATTRIBUTE_NAME_VEHICLE  => $this->createVehicleArray(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid departure time
        try {
            Departure::fromResponse([
                    Departure::ATTRIBUTE_NAME_DEPARTURE_TIME => $this->getFaker()->word,
                    Departure::ATTRIBUTE_NAME_VEHICLE        => $this->createVehicleArray(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid vehicle
        try {
            Departure::fromResponse([
                    Departure::ATTRIBUTE_NAME_DEPARTURE_TIME => $this->createDepartureTimeArray(),
                    Departure::ATTRIBUTE_NAME_VEHICLE        => $this->getFaker()->word,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
