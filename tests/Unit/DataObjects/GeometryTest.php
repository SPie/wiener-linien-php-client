<?php

use SPie\WienerLinien\Response\DataObjects\Coordinates;
use SPie\WienerLinien\Response\DataObjects\Geometry;

/**
 * Class GeometryTest
 */
class GeometryTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Geometry::class,
            new Geometry(
                $this->getFaker()->word,
                $this->createCoordinates()
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //empty type
        try {
            new Geometry(
                null,
                $this->createCoordinates()
            );

            $this->assertTrue(false);
        } catch (Throwable $e) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            new Geometry(
                $this->getFaker()->numberBetween(),
                $this->createCoordinates()
            );

            $this->assertTrue(false);
        } catch (Throwable $e) {
            $this->assertTrue(true);
        }

        //empty coordinates
        try {
            new Geometry(
                $this->getFaker()->word,
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $e) {
            $this->assertTrue(true);
        }

        //invalid coordinates
        try {
            new Geometry(
                $this->getFaker()->word,
                $this->getFaker()->word
            );

            $this->assertTrue(false);
        } catch (Throwable $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     */
    public function testFromResponse(): void
    {
        $this->assertInstanceOf(
            Geometry::class,
            Geometry::fromResponse([
                Geometry::ATTRIBUTE_NAME_TYPE        => $this->getFaker()->word,
                Geometry::ATTRIBUTE_NAME_COORDINATES => $this->createCoordinatesArray(),
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
            Geometry::fromResponse([
                Geometry::ATTRIBUTE_NAME_COORDINATES => [
                    Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->randomFloat(),
                    Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->randomFloat(),
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            Geometry::fromResponse([
                Geometry::ATTRIBUTE_NAME_TYPE        => $this->getFaker()->numberBetween(),
                Geometry::ATTRIBUTE_NAME_COORDINATES => $this->createCoordinatesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty coordinates
        try {
            Geometry::fromResponse([
                Geometry::ATTRIBUTE_NAME_TYPE => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid coordinates
        try {
            Geometry::fromResponse([
                Geometry::ATTRIBUTE_NAME_TYPE        => $this->getFaker()->word,
                Geometry::ATTRIBUTE_NAME_COORDINATES => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
