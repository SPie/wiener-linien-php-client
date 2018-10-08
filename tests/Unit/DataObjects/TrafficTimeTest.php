<?php

use SPie\WienerLinien\Response\DataObjects\TrafficTime;

/**
 * Class TrafficTimeTest
 */
class TrafficTimeTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficTime::class,
            new TrafficTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            TrafficTime::class,
            new TrafficTime(
                null,
                null,
                null
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //invalid start
        try {
            new TrafficTime(
                $this->getFaker()->word,
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid end
        try {
            new TrafficTime(
                $this->getFaker()->dateTime,
                $this->getFaker()->word,
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid resume
        try {
            new TrafficTime(
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
            TrafficTime::class,
            TrafficTime::fromResponse([
                TrafficTime::ATTRIBUTE_NAME_START  => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_END    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_RESUME => $this->getFaker()->dateTime->format('Y-m-d H:i:s')
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //invalid start
        try {
            TrafficTime::fromResponse([
                TrafficTime::ATTRIBUTE_NAME_START  => $this->getFaker()->word,
                TrafficTime::ATTRIBUTE_NAME_END    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_RESUME => $this->getFaker()->dateTime->format('Y-m-d H:i:s')
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid end
        try {
            TrafficTime::fromResponse([
                TrafficTime::ATTRIBUTE_NAME_START  => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_END    => $this->getFaker()->word,
                TrafficTime::ATTRIBUTE_NAME_RESUME => $this->getFaker()->dateTime->format('Y-m-d H:i:s')
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid resume
        try {
            TrafficTime::fromResponse([
                TrafficTime::ATTRIBUTE_NAME_START  => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_END    => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
                TrafficTime::ATTRIBUTE_NAME_RESUME => $this->getFaker()->word
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
