<?php

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Mock\Client as MockClient;
use Psr\Http\Message\ResponseInterface;
use SPie\WienerLinien\Client;
use SPie\WienerLinien\Exception\InvalidFaultTypeException;
use SPie\WienerLinien\Exception\InvalidRequestParameterException;
use SPie\WienerLinien\Exception\InvalidResponseException;
use SPie\WienerLinien\Response\DataObjects\Monitor;
use SPie\WienerLinien\Response\DataObjects\Poi;
use SPie\WienerLinien\Response\DataObjects\PoiCategory;
use SPie\WienerLinien\Response\DataObjects\PoiCategoryGroup;
use SPie\WienerLinien\Response\DataObjects\TrafficInfo;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategory;
use SPie\WienerLinien\Response\DataObjects\TrafficInfoCategoryGroup;
use SPie\WienerLinien\Response\MonitorResponse;
use SPie\WienerLinien\Response\NewsListResponse;
use SPie\WienerLinien\Response\ResponseMessage;
use SPie\WienerLinien\Response\TrafficInfoListResponse;

/**
 * Class ClientTest
 */
class ClientTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Client::class,
            new Client(
                $this->getFaker()->uuid,
                $this->createHttpClient(),
                $this->createMessageFactory(),
                $this->getFaker()->url
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            Client::class,
            new Client($this->getFaker()->uuid)
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty sender id
        try {
            new Client(
                null,
                $this->createHttpClient(),
                $this->createMessageFactory(),
                $this->getFaker()->url
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid sender id
        try {
            new Client(
                $this->getFaker()->numberBetween(),
                $this->createHttpClient(),
                $this->createMessageFactory(),
                $this->getFaker()->url
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid http client
        try {
            new Client(
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->createMessageFactory(),
                $this->getFaker()->url
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid message factory
        try {
            new Client(
                $this->getFaker()->uuid,
                $this->createHttpClient(),
                $this->getFaker()->word,
                $this->getFaker()->url
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid api endpoint
        try {
            new Client(
                $this->getFaker()->uuid,
                $this->createHttpClient(),
                $this->createMessageFactory(),
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testCreateParameterStringSinglePair(): void
    {
        $key = $this->getFaker()->uuid;
        $parameter = $this->getFaker()->uuid;

        $this->assertEquals(
            $key . '=' . $parameter,
            $this->getReflectionMethod('createParameterString')->invokeArgs(
                $this->createClient(),
                [
                    'parameters' => [
                        $key => $parameter,
                    ],
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testCreateParameterStringMultiplePairs(): void
    {
        $key1 = $this->getFaker()->uuid;
        $parameter1 = $this->getFaker()->uuid;
        $key2 = $this->getFaker()->uuid;
        $parameter2 = $this->getFaker()->uuid;

        $this->assertEquals(
            $key1 . '=' . $parameter1 . '&' . $key2 . '=' . $parameter2,
            $this->getReflectionMethod('createParameterString')->invokeArgs(
                $this->createClient(),
                [
                    'parameters' => [
                        $key1 => $parameter1,
                        $key2 => $parameter2,
                    ]
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testCreateParameterStringArrayParameter(): void
    {
        $key = $this->getFaker()->uuid;
        $parameter = $this->getFaker()->uuid;

        $this->assertEquals(
            $key . '=' . $parameter,
            $this->getReflectionMethod('createParameterString')->invokeArgs(
                $this->createClient(),
                [
                    'parameters' => [
                        $key => [
                            $parameter
                        ],
                    ],
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testCreateParameterStringEmptyParameter(): void
    {
        $this->assertEquals(
            null,
            $this->getReflectionMethod('createParameterString')->invokeArgs(
                $this->createClient(),
                [
                    'parameters' => [
                        $this->getFaker()->uuid => null,
                    ],
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testBuildUr(): void
    {
        $senderId = $this->getFaker()->uuid;
        $apiEndpoint = $this->getFaker()->url;
        $action = $this->getFaker()->uuid;
        $key = $this->getFaker()->uuid;
        $parameter = $this->getFaker()->uuid;

        $this->assertEquals(
            $apiEndpoint . $action . '?' . Client::ACTION_PARAMETER_SENDER . '=' . $senderId . '&'
                . $key . '=' . $parameter,
            $this->getReflectionMethod('buildUri')->invokeArgs(
                $this->createClient($senderId, $apiEndpoint),
                [
                    $action,
                    [
                        $key => $parameter
                    ],
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testSendRequest(): void
    {
        $response = [
            $this->getFaker()->uuid => $this->getFaker()->uuid,
        ];

        $httpClient = $this->createHttpClient();
        $httpClient->addResponse($this->createResponse($response));

        $this->assertEquals(
            $response,
            $this->getReflectionMethod('sendRequest')->invokeArgs(
                $this->createClient(null, null, $httpClient),
                [
                    $this->getFaker()->uuid,
                    [
                        $this->getFaker()->uuid => $this->getFaker()->uuid,
                    ]
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testSenRequestInvalidResponse(): void
    {
        try {
            $response = [null];

            $httpClient = $this->createHttpClient();
            $httpClient->addResponse($this->createResponse($response));

            $this->getReflectionMethod('sendRequest')->invokeArgs(
                $this->createClient(null, null, $httpClient),
                [
                    $this->getFaker()->uuid,
                    [
                        $this->getFaker()->uuid => $this->getFaker()->uuid,
                    ]
                ]
            );

            $this->assertTrue(true);
        } catch (InvalidResponseException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testGetMonitors(): void
    {
        $monitor = $this->createMonitorArray();
        $trafficInfoCategoryGroup = $this->createTrafficInfoCategoryGroupArray();
        $trafficInfoCategory = $this->createTrafficInfoCategoryArray();
        $trafficInfo = $this->createTrafficInfoArray();
        $responseMessage = $this->createResponseMessageArray();

        $httpClient = $this->createHttpClient();
        $httpClient->addResponse($this->createResponse([
            MonitorResponse::ATTRIBUTE_NAME_DATA => [
                MonitorResponse::ATTRIBUTE_NAME_MONITORS => [
                    $monitor,
                ],
                MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                    $trafficInfoCategoryGroup,
                ],
                MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                    $trafficInfoCategory,
                ],
                MonitorResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS => [
                    $trafficInfo,
                ],
            ],
            MonitorResponse::ATTRIBUTE_NAME_MESSAGE => $responseMessage,
        ]));

        $this->assertEquals(
            new MonitorResponse(
                [Monitor::fromResponse($monitor)],
                [TrafficInfoCategoryGroup::fromResponse($trafficInfoCategoryGroup)],
                [TrafficInfoCategory::fromResponse($trafficInfoCategory)],
                [TrafficInfo::fromResponse($trafficInfo)],
                ResponseMessage::fromResponse($responseMessage)
            ),
            $this->getReflectionMethod('getMonitors')->invokeArgs(
                $this->createClient(null, null, $httpClient),
                [
                    [
                        $this->getFaker()->uuid,
                    ],
                    [
                        Client::FAULT_TYPE_FAULT_SHORT,
                    ],
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testGetMonitorsInvalidStationNumbers(): void
    {
        try {
            $this->getReflectionMethod('getMonitors')->invokeArgs(
                $this->createClient(),
                [
                    [],
                    [
                        Client::FAULT_TYPE_FAULT_SHORT,
                    ],
                ]
            );

            $this->assertTrue(false);
        } catch (InvalidRequestParameterException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testGetMonitorsInvalidFaultType(): void
    {
        try {
            $this->getReflectionMethod('getMonitors')->invokeArgs(
                $this->createClient(),
                [
                    [
                        $this->getFaker()->uuid
                    ],
                    [
                        $this->getFaker()->word,
                    ],
                ]
            );

            $this->assertTrue(false);
        } catch (InvalidFaultTypeException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testGetTrafficInfoList(): void
    {
        $trafficInfoCategoryGroup = $this->createTrafficInfoCategoryGroupArray();
        $trafficInfoCategory = $this->createTrafficInfoCategoryArray();
        $trafficInfo = $this->createTrafficInfoArray();

        $httpClient = $this->createHttpClient();
        $httpClient->addResponse($this->createResponse([
            TrafficInfoListResponse::ATTRIBUTE_NAME_DATA => [
                TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORY_GROUPS => [
                    $trafficInfoCategoryGroup,
                ],
                TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFO_CATEGORIES => [
                    $trafficInfoCategory,
                ],
                TrafficInfoListResponse::ATTRIBUTE_NAME_TRAFFIC_INFOS => [
                    $trafficInfo,
                ],
            ],
        ]));

        $this->assertEquals(
            new TrafficInfoListResponse(
                [TrafficInfoCategoryGroup::fromResponse($trafficInfoCategoryGroup)],
                [TrafficInfoCategory::fromResponse($trafficInfoCategory)],
                [TrafficInfo::fromResponse($trafficInfo)]
            ),
            $this->getReflectionMethod('getTrafficInfoList')->invokeArgs(
                $this->createClient(null, null, $httpClient),
                [
                    [
                        $this->getFaker()->uuid,
                    ],
                    [
                        $this->getFaker()->uuid,
                    ],
                    [
                        $this->getFaker()->uuid,
                    ]
                ]
            )
        );
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testGetNewsList(): void
    {
        $poiCategoryGroup = $this->createPoiCategoryGroupArray();
        $poiCategory = $this->createPoiCategoryArray();
        $poi = $this->createPoiArray();

        $httpClient = $this->createHttpClient();
        $httpClient->addResponse($this->createResponse([
            NewsListResponse::ATTRIBUTE_NAME_DATA => [
                NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS => [
                    $poiCategoryGroup,
                ],
                NewsListResponse::ATTRIBUTE_NAME_POI_CATEGORIES => [
                    $poiCategory,
                ],
                NewsListResponse::ATTRIBUTE_NAME_POIS => [
                    $poi,
                ],
            ],
        ]));

        $this->assertEquals(
            new NewsListResponse(
                [PoiCategoryGroup::fromResponse($poiCategoryGroup)],
                [PoiCategory::fromResponse($poiCategory)],
                [Poi::fromResponse($poi)]
            ),
            $this->getReflectionMethod('getNewsList')->invokeArgs(
                $this->createClient(null, null, $httpClient),
                [
                    [
                        $this->getFaker()->uuid,
                    ],
                    [
                        $this->getFaker()->uuid,
                    ],
                    [
                        $this->getFaker()->uuid,
                    ]
                ]
            )
        );
    }

    //endregion

    /**
     * @param string|null     $senderId
     * @param string|null     $apiEndpoint
     * @param HttpClient|null $httpClient
     *
     * @return Client
     */
    private function createClient(
        string $senderId = null,
        string $apiEndpoint = null,
        HttpClient $httpClient = null
    ): Client
    {
        return new Client(
            $senderId ?: $this->getFaker()->uuid,
            $httpClient ?: $this->createHttpClient(),
            $this->createMessageFactory(),
            $apiEndpoint ?: $this->getFaker()->url
        );
    }

    /**
     * @return HttpClient|MockClient
     */
    private function createHttpClient(): HttpClient
    {
        return new MockClient();
    }

    /**
     * @return MessageFactory
     */
    private function createMessageFactory(): MessageFactory
    {
        return new GuzzleMessageFactory();
    }

    /**
     * @param string $methodName
     *
     * @return ReflectionMethod
     *
     * @throws ReflectionException
     */
    private function getReflectionMethod(string $methodName): \ReflectionMethod
    {
        $createParameterStringMethod = new \ReflectionMethod(Client::class, $methodName);
        $createParameterStringMethod->setAccessible(true);

        return $createParameterStringMethod;
    }

    /**
     * @param array $responseBody
     * @param int   $statusCode
     * @param array $headers
     *
     * @return ResponseInterface
     */
    private function createResponse(
        array $responseBody = [],
        int $statusCode = 200,
        array $headers = []
    ): ResponseInterface
    {
        return ($this->createMessageFactory())->createResponse(
            $statusCode,
            null,
            $headers,
            \json_encode($responseBody)
        );
    }
}
