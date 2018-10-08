<?php

use SPie\WienerLinien\Response\DataObjects\LocationStop;

/**
 * Class LocationStopTest
 */
class LocationStopTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            LocationStop::class,
            new LocationStop(
                $this->getFaker()->uuid,
                $this->createGeometry(),
                $this->createProperties()
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //empty type
        try {
            new LocationStop(
                null,
                $this->createGeometry(),
                $this->createProperties()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            new LocationStop(
                $this->getFaker()->numberBetween(),
                $this->createGeometry(),
                $this->createProperties()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty geometry
        try {
            new LocationStop(
                $this->getFaker()->uuid,
                null,
                $this->createProperties()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid geometry
        try {
            new LocationStop(
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->createProperties()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty properties
        try {
            new LocationStop(
                $this->getFaker()->uuid,
                $this->createGeometry(),
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid properties
        try {
            new LocationStop(
                $this->getFaker()->uuid,
                $this->createGeometry(),
                $this->getFaker()->word
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
            LocationStop::class,
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->uuid,
                LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->createGeometryArray(),
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty type
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->createGeometryArray(),
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->numberBetween(),
                LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->createGeometryArray(),
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty geometry
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->uuid,
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid geometry
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->uuid,
                LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->getFaker()->word,
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->createPropertiesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty properties
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE     => $this->getFaker()->uuid,
                LocationStop::ATTRIBUTE_NAME_GEOMETRY => $this->createGeometryArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid properties
        try {
            LocationStop::fromResponse([
                LocationStop::ATTRIBUTE_NAME_TYPE       => $this->getFaker()->uuid,
                LocationStop::ATTRIBUTE_NAME_GEOMETRY   => $this->createGeometryArray(),
                LocationStop::ATTRIBUTE_NAME_PROPERTIES => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
