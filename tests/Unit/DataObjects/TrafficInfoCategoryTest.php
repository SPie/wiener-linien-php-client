<?php

use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategory;

/**
 * Class TrafficInfoCategoryTest
 */
class TrafficInfoCategoryTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficInfoCategory::class,
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
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
            new TrafficInfoCategory(
                null,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            new TrafficInfoCategory(
                $this->getFaker()->word,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref traffic info category group id
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                null,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info category group id
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->word,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty name
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                null,
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                [
                    $this->getFaker()->uuid,
                ],
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref traffic info names
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info names
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
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

        //invalid title
        try {
            new TrafficInfoCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid,
                ],
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
            TrafficInfoCategory::class,
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty id
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->word,
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref traffic info category group id
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref traffic info category group id
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->word,
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty name
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info name list
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info name list
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => [],
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            TrafficInfoCategory::fromResponse([
                TrafficInfoCategory::ATTRIBUTE_NAME_ID                                 => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_REF_TRAFFIC_INFO_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
                TrafficInfoCategory::ATTRIBUTE_NAME_NAME                               => $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TRAFFIC_INFO_NAME_LIST             => $this->getFaker()->uuid
                    . ',' . $this->getFaker()->uuid,
                TrafficInfoCategory::ATTRIBUTE_NAME_TITLE                              => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
