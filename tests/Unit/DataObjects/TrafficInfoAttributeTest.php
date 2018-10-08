<?php

use SPie\WienerLinien\Response\DataObjects\TrafficInfoAttribute;

/**
 * Class TrafficInfoAttributeTest
 */
class TrafficInfoAttributeTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficInfoAttribute::class,
            new TrafficInfoAttribute(
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
            TrafficInfoAttribute::class,
            new TrafficInfoAttribute(
                null,
                null,
                null,
                null,
                null,
                [
                    $this->getFaker()->uuid,
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
        //invalid status
        try {
            new TrafficInfoAttribute(
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
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid station
        try {
            new TrafficInfoAttribute(
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
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid location
        try {
            new TrafficInfoAttribute(
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
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid reason
        try {
            new TrafficInfoAttribute(
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
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid towards
        try {
            new TrafficInfoAttribute(
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
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related lines
        try {
            new TrafficInfoAttribute(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related lines
        try {
            new TrafficInfoAttribute(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                [
                    $this->getFaker()->uuid,
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related stops
        try {
            new TrafficInfoAttribute(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related stops
        try {
            new TrafficInfoAttribute(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
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
            TrafficInfoAttribute::class,
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //invalid status
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->numberBetween(),
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid station
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->numberBetween(),
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid location
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->numberBetween(),
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid reason
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->numberBetween(),
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid towards
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->numberBetween(),
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related lines
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related lines
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => [],
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related stops
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related stops
        try {
            TrafficInfoAttribute::fromResponse([
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATUS        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_STATION       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_LOCATION      => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_REASON        => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_TOWARDS       => $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoAttribute::ATTRIBUTE_NAME_RELATED_STOPS => [],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
