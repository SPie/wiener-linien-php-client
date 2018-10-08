<?php

use SPie\WienerLinien\Response\DataObjects\DepartureTime;

/**
 * Class DepartureTimeTest
 */
class DepartureTimeTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            DepartureTime::class,
            new DepartureTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime,
                $this->getFaker()->numberBetween()
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            DepartureTime::class,
            new DepartureTime(
                $this->getFaker()->dateTime,
                null,
                $this->getFaker()->numberBetween()
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //empty time planned
        try {
            new DepartureTime(
                null,
                $this->getFaker()->dateTime,
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid time planned
        try {
            new DepartureTime(
                $this->getFaker()->word,
                $this->getFaker()->dateTime,
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid time real
        try {
            new DepartureTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty countdown
        try {
            new DepartureTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime,
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid countdown
        try {
            new DepartureTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime,
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
            DepartureTime::class,
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->numberBetween(),
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {
        //empty time planned
        try {
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid time planned
        try {
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->word,
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid time real
        try {
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->word,
                DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty countdown
        try {
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid countdown
        try {
            DepartureTime::fromResponse([
                DepartureTime::ATTRIBUTE_NAME_TIME_PLANNED => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_TIME_REAL    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                DepartureTime::ATTRIBUTE_NAME_COUNTDOWN    => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
