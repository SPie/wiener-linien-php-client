<?php

use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategoryGroup;

/**
 * Class TrafficInfoCategoryGroupTest
 */
class TrafficInfoCategoryGroupTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficInfoCategoryGroup::class,
            new TrafficInfoCategoryGroup(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty id
        try {
            new TrafficInfoCategoryGroup(
                null,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            new TrafficInfoCategoryGroup(
                $this->getFaker()->word,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty name
        try {
            new TrafficInfoCategoryGroup(
                $this->getFaker()->numberBetween(),
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new TrafficInfoCategoryGroup(
                $this->getFaker()->numberBetween(),
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
            TrafficInfoCategoryGroup::class,
            TrafficInfoCategoryGroup::fromResponse([
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_ID   => $this->getFaker()->numberBetween(),
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {
        //empty id
        try {
            TrafficInfoCategoryGroup::fromResponse([
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            TrafficInfoCategoryGroup::fromResponse([
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_ID   => $this->getFaker()->word,
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty name
        try {
            TrafficInfoCategoryGroup::fromResponse([
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            TrafficInfoCategoryGroup::fromResponse([
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_ID   => $this->getFaker()->numberBetween(),
                TrafficInfoCategoryGroup::ATTRIBUTE_NAME_NAME => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
