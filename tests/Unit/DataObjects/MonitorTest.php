<?php

use SPie\WienerLinien\Response\DataObjects\Monitor;

/**
 * Class MonitorTest
 */
class MonitorTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Monitor::class,
            new Monitor(
                $this->createLocationStop(),
                [
                    $this->createLine(),
                ],
                [
                    $this->getFaker()->uuid,
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty location stop
        try {
            new Monitor(
                null,
                [
                    $this->createLine(),
                ],
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid location stop
        try {
            new Monitor(
                $this->getFaker()->word,
                [
                    $this->createLine(),
                ],
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty lines
        try {
            new Monitor(
                $this->createLocationStop(),
                null,
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid lines
        try {
            new Monitor(
                $this->createLocationStop(),
                $this->getFaker()->word,
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref traffic info names
        try {
            new Monitor(
                $this->createLocationStop(),
                [
                    $this->createLine(),
                ],
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info names
        try {
            new Monitor(
                $this->createLocationStop(),
                [
                    $this->createLine(),
                ],
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
            Monitor::class,
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
                Monitor::ATTRIBUTE_NAME_LINES => [
                    $this->createLineArray(),
                ],
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {

        //empty location stop
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LINES => [
                    $this->createLineArray(),
                ],
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid location stop
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->getFaker()->word,
                Monitor::ATTRIBUTE_NAME_LINES => [
                    $this->createLineArray(),
                ],
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty lines
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid lines
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
                Monitor::ATTRIBUTE_NAME_LINES => $this->getFaker()->word,
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref traffic info names
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
                Monitor::ATTRIBUTE_NAME_LINES => [
                    $this->createLineArray(),
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info names
        try {
            Monitor::fromResponse([
                Monitor::ATTRIBUTE_NAME_LOCATION_STOP => $this->createLocationStopArray(),
                Monitor::ATTRIBUTE_NAME_LINES => [
                    $this->createLineArray(),
                ],
                Monitor::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_NAMES => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
