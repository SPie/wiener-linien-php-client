<?php

use SPie\WienerLinien\Response\DataObjects\Coordinates;

/**
 * Class CoordinatesTest
 */
class CoordinatesTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $coordinates = new Coordinates(
            $this->getFaker()->randomFloat(),
            $this->getFaker()->randomFloat()
        );

        $this->assertInstanceOf(Coordinates::class, $coordinates);
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //invalid latitude
        try {
            new Coordinates(
                $this->getFaker()->word,
                $this->getFaker()->randomFloat()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid longitude
        try {
            new Coordinates(
                $this->getFaker()->randomFloat(),
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
            Coordinates::class,
            Coordinates::fromResponse([
                Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->randomFloat(),
                Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->randomFloat(),
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //invalid latitude
        try {
            Coordinates::fromResponse([
                Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->word,
                Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->randomFloat(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty latitude
        try {
            Coordinates::fromResponse([
                Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->randomFloat(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid longitude
        try {
            Coordinates::fromResponse([
                Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->randomFloat(),
                Coordinates::ATTRIBUTE_NAME_LONGITUDE => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty latitude
        try {
            Coordinates::fromResponse([
                Coordinates::ATTRIBUTE_NAME_LATITUDE  => $this->getFaker()->randomFloat(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
