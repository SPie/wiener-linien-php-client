<?php

use SPie\WienerLinien\Response\DataObjects\TrafficInfo;

/**
 * Class TrafficInfoTest
 */
class TrafficInfoTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficInfo::class,
            new TrafficInfo(
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
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            TrafficInfo::class,
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                null,
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                [
                    $this->getFaker()->uuid,
                ],
                null,
                [
                    $this->createTrafficInfoAttribute(),
                ]
            )
        );
    }

    public function testInvalidConstruct(): void
    {

        //empty ref traffic info category id
        try {
            new TrafficInfo(
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info category id
        try {
            new TrafficInfo(
                $this->getFaker()->word,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty name
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid priority
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid owner
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty description
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid description
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related lines
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                [
                    $this->getFaker()->uuid,
                ],
                $this->createTrafficTime(),
                [
                    $this->createTrafficInfoAttribute(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related lines
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                [
                    $this->getFaker()->uuid,
                ],
                $this->createTrafficTime(),
                [
                    $this->createTrafficInfoAttribute(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related stops
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                null,
                $this->createTrafficTime(),
                [
                    $this->createTrafficInfoAttribute(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related stops
        try {
            new TrafficInfo(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->word,
                $this->createTrafficTime(),
                [
                    $this->createTrafficInfoAttribute(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic time
        try {
            new TrafficInfo(
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
                $this->getFaker()->word,
                [
                    $this->createTrafficInfoAttribute(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty attributes
        try {
            new TrafficInfo(
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
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid attributes
        try {
            new TrafficInfo(
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
                $this->getFaker()->word
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
