<?php

use SPie\WienerLinien\Response\DataObjects\Vehicle;

/**
 * Class VehicleTest
 */
class VehicleTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Vehicle::class,
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            Vehicle::class,
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                null,
                null,
                null,
                $this->getFaker()->uuid
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty name
        try {
            new Vehicle(
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new Vehicle(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction id
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction id
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid barrier free
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid realtime supported
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic jam
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            new Vehicle(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->numberBetween()
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
            Vehicle::class,
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty name
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction id
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction id
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->word,
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid barrier free
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->word,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid realtime supported
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->word,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic jam
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->word,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            Vehicle::fromResponse([
                Vehicle::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Vehicle::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Vehicle::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Vehicle::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
