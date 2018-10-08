<?php

use SPie\WienerLinien\Response\NewsListResponse;

/**
 * Class NewsListResponseTest
 */
class NewsListResponseTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            NewsListResponse::class,
            new NewsListResponse(
                [
                    $this->createPoiCategoryGroup(),

                ],
                [
                    $this->createPoiCategory(),
                ],
                [
                    $this->createPoi()
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty poi category groups
        try {
            new NewsListResponse(
                null,
                [
                    $this->createPoiCategory(),
                ],
                [
                    $this->createPoi()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid poi category groups
        try {
            new NewsListResponse(
                $this->getFaker()->word,
                [
                    $this->createPoiCategory(),
                ],
                [
                    $this->createPoi()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty poi categories
        try {
            new NewsListResponse(
                [
                    $this->createPoiCategoryGroup(),

                ],
                null,
                [
                    $this->createPoi()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid poi categories
        try {
            new NewsListResponse(
                [
                    $this->createPoiCategoryGroup(),

                ],
                $this->getFaker()->word,
                [
                    $this->createPoi()
                ]
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty pois
        try {
            new NewsListResponse(
                [
                    $this->createPoiCategoryGroup(),

                ],
                [
                    $this->createPoiCategory(),
                ],
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid pois
        try {
            new NewsListResponse(
                [
                    $this->createPoiCategoryGroup(),

                ],
                [
                    $this->createPoiCategory(),
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
            NewsListResponse::class,
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                        $this->createPoiCategoryGroupArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES => [
                        $this->createPoiCategoryArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POIS => [
                        $this->createPoiArray(),
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
            NewsListResponse::fromResponse([]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid data
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty poi category groups
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES => [
                        $this->createPoiCategoryArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POIS           => [
                        $this->createPoiArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid poi category groups
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => $this->getFaker()->word,
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES      => [
                        $this->createPoiCategoryArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POIS                => [
                        $this->createPoiArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty poi categories
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                        $this->createPoiCategoryGroupArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POIS                => [
                        $this->createPoiArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid poi categories
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                        $this->createPoiCategoryGroupArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES      => $this->getFaker()->word,
                    NewsListResponse::ATTRIBUTE_NAME_POIS                => [
                        $this->createPoiArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty pois
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                        $this->createPoiCategoryGroupArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES      => [
                        $this->createPoiCategoryArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid pois
        try {
            NewsListResponse::fromResponse([
                NewsListResponse::ATTRIBUTE_NAME_DATA => [
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                        $this->createPoiCategoryGroupArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES      => [
                        $this->createPoiCategoryArray(),
                    ],
                    NewsListResponse::ATTRIBUTE_NAME_POIS                => $this->getFaker()->word,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
