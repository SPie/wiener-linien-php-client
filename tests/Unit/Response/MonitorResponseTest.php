<?php

use SPie\WienerLinien\Response\MonitorResponse;

/**
 * Class MonitorResponseTest
 */
class MonitorResponseTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            MonitorResponse::class,
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty monitor
        try {
            new MonitorResponse(
                null,
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid monitor
        try {
            new MonitorResponse(
                $this->getFaker()->word,
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info category group
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                null,
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category group
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                $this->getFaker()->word,
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info category
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                null,
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                $this->getFaker()->word,
                [
                    $this->createTrafficInfo()
                ],
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                null,
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic infor
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                $this->getFaker()->word,
                $this->createResponseMessage()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty response message
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
                ],
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid response message
        try {
            new MonitorResponse(
                [
                    $this->createMonitor(),
                ],
                [
                    $this->createTrafficInfoCategoryGroup(),
                ],
                [
                    $this->createTrafficInfoCategory(),
                ],
                [
                    $this->createTrafficInfo()
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
            MonitorResponse::class,
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
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
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty response message
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid response message
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty monitors
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid monitors
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => $this->getFaker()->word,
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info category groups
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS           => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info category groups
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => $this->getFaker()->word,
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic info categories
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic info categories
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => $this->getFaker()->word,
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => [
                        $this->createTrafficInfoArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty traffic infos
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid traffic infos
        try {
            MonitorResponse::fromResponse([
                MonitorResponse::ATTRIBUTE_NAME_DATA    => [
                    MonitorResponse::ATTRIBUTE_NAME_MONITORS                     => [
                        $this->createMonitorArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                        $this->createTrafficInfoCategoryGroupArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES      => [
                        $this->createTrafficInfoCategoryArray(),
                    ],
                    MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS                => $this->getFaker()->word,
                ],
                MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $this->createResponseMessageArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
