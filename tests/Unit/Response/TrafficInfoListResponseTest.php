<?php

use SPie\WienerLinien\Response\TrafficInfoListResponse;

/**
 * Class TrafficInfoListResponseTest
 */
class TrafficInfoListResponseTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            TrafficInfoListResponse::class,
            new TrafficInfoListResponse(
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty traffic info category groups
        try {
            new TrafficInfoListResponse(
                null,
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category groups
        try {
            new TrafficInfoListResponse(
                $this->getFaker()->word,
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info categories
        try {
            new TrafficInfoListResponse(
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                null,
                [
                    $this->createTrafficInfo()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info categories
        try {
            new TrafficInfoListResponse(
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                $this->getFaker()->word,
                [
                    $this->createTrafficInfo()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic infos
        try {
            new TrafficInfoListResponse(
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic infos
        try {
            new TrafficInfoListResponse(
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
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
            TrafficInfoListResponse::class,
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS => [
                        $this->createTrafficInfoArray()
                    ],
                ],
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty data
        try {
            TrafficInfoListResponse::fromResponse([]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid data
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info category groups
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS           => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category groups
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => $this->getFaker()->word,
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info categories
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category groups
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => $this->getFaker()->word,
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic infos
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic infos
        try {
            TrafficInfoListResponse::fromResponse([
                TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => $this->getFaker()->word,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
