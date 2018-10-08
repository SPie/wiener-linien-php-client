<?php

use SPie\WienerLinien\Response\DataObjects\Line;

/**
 * Class LineTest
 */
class LineTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Line::class,
            new Line(
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
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            Line::class,
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                null,
                null,
                null,
                $this->getFaker()->word,
                null,
                [
                    $this->createDeparture(),
                ]
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //empty name
        try {
            new Line(
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new Line(
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty towards
        try {
            new Line(
                null,
                $this->getFaker()->uuid,
                null,
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid towards
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction id
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction id
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid barrier free
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }


        //invalid realtime supported
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic jam
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                null,
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid line id
        try {
            new Line(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->boolean,
                $this->getFaker()->word,
                $this->getFaker()->word,
                [
                    $this->createDeparture(),
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid departures
        try {
            new Line(
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
                    $this->getFaker()->word,
                ]
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
            Line::class,
            Line::fromResponse([
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
            Line::fromResponse([
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->numberBetween(),
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty towards
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid towards
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->numberBetween(),
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->numberBetween(),
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty direction id
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid direction id
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->word,
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
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid barrier free
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid realtime supported
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic jam
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid line id
        try {
            Line::fromResponse([
                Line::ATTRIBUTE_NAME_NAME               => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_TOWARDS            => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION          => $this->getFaker()->uuid,
                Line::ATTRIBUTE_NAME_DIRECTION_ID       => $this->getFaker()->numberBetween(),
                Line::ATTRIBUTE_NAME_BARRIER_FREE       => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_REALTIME_SUPPORTED => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TRAFFIC_JAM        => $this->getFaker()->boolean,
                Line::ATTRIBUTE_NAME_TYPE               => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_LINE_ID            => $this->getFaker()->word,
                Line::ATTRIBUTE_NAME_DEPARTURES         => [
                    Line::ATTRIBUTE_NAME_DEPARTURE => [
                        $this->createDepartureArray()
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid departures
        try {
            Line::fromResponse([
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
                        $this->getFaker()->word
                    ]
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
