<?php

namespace SPie\WienerLinien;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use SPie\WienerLinien\Exception\InvalidFaultTypeException;
use SPie\WienerLinien\Exception\InvalidResponseException;
use SPie\WienerLinien\Response\MonitorResponse;
use SPie\WienerLinien\Response\NewsListResponse;
use SPie\WienerLinien\Response\TrafficInfoListResponse;

/**
 * Class Client
 *
 * @package SPie\WienerLinien
 */
class Client
{

    /*
     * Default API endpoint.
     */
    const API_ENDPOINT = 'http://www.wienerlinien.at/ogd_realtime/';

    const METHOD_GET  = 'GET';

    /*
     * sdk action name constants
     */
    const ACTION_NAME_MONITOR           = 'monitor';
    const ACTION_NAME_TRAFFIC_INFO_LIST = 'trafficInfoList';
    const ACTION_NAME_NEWS_LIST         = 'newsList';

    const ACTION_PARAMETER_SENDER                = 'sender';
    const ACTION_PARAMETER_RBL_NUMBER            = 'rbl';
    const ACTION_PARAMETER_ACTIVATE_TRAFFIC_INFO = 'activateTrafficInfo';
    const ACTION_PARAMETER_RELATED_LINE          = 'relatedLine';
    const ACTION_PARAMETER_RELATED_STOP          = 'relatedStop';
    const ACTION_PARAMETER_NAME                  = 'name';

    /*
     * Fault type constants.
     */
    const FAULT_TYPE_FAULT_SHORT   = 'stoerungkurz';
    const FAULT_TYPE_FAULT_LONG    = 'stoerunglang';
    const FAULT_TYPE_ELEVATOR_INFO = 'aufzugsinfo';

    const RESPONSE_PARAMETER_DATA = 'data';

    /**
     * The Wiener Linien sender id for authentication.
     *
     * @var string $senderId
     */
    private $senderId;

    /**
     * The HTTP Client to send requests to the Wiener Linien API.
     *
     * @var HttpClient $httpClient
     */
    private $httpClient;

    /**
     * Message factory to create request.
     *
     * @var MessageFactory $messageFactory
     */
    private $messageFactory;

    /**
     * The Wiener Linien API endpoint.
     *
     * @var string $apiEndpoint
     */
    private $apiEndpoint;

    /**
     * Client constructor.
     *
     * @param string              $senderId
     * @param HttpClient|null     $httpClient
     * @param MessageFactory|null $messageFactory
     * @param string|null         $apiEndpoint
     */
    public function __construct(
        string $senderId,
        HttpClient $httpClient = null,
        MessageFactory $messageFactory = null,
        string $apiEndpoint = null
    ) {
        $this->senderId = $senderId;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->messageFactory = $messageFactory ?: MessageFactoryDiscovery::find();
        $this->apiEndpoint = $apiEndpoint ?: self::API_ENDPOINT;
    }

    /**
     * Getter for the specified senderId
     *
     * @return string
     */
    protected function getSenderId(): string
    {
        return $this->senderId;
    }

    /**
     * Getter for the clients http client.
     *
     * @return HttpClient
     */
    protected function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Getter for the message factory.
     *
     * @return MessageFactory
     */
    protected function getMessageFactory(): MessageFactory
    {
        return $this->messageFactory;
    }

    /**
     * Getter for the specified api endpoint
     *
     * @return string
     */
    protected function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    //region SKD methods

    /**
     * Real time data for one or more given stations with optional fault type infos.
     *
     * @param string|string[] $stationNumbers
     * @param string|string[] $faultTypes
     *
     * @return MonitorResponse
     *
     * @throws InvalidFaultTypeException
     * @throws InvalidResponseException
     */
    public function getMonitors(array $stationNumbers, array $faultTypes = []): MonitorResponse
    {
        //validate fault type parameter
        if (
            !empty($faultTypes)
            && !\in_array($faultTypes, [
                self::FAULT_TYPE_FAULT_SHORT,
                self::FAULT_TYPE_FAULT_LONG,
                self::FAULT_TYPE_ELEVATOR_INFO,
            ])
        ) {
            throw new InvalidFaultTypeException('Fault type ' . $faultTypes . ' is not valid');
        }

        return MonitorResponse::fromResponse($this->sendRequest(
            self::ACTION_NAME_MONITOR,
            [
                self::ACTION_PARAMETER_RBL_NUMBER            => $stationNumbers,
                self::ACTION_PARAMETER_ACTIVATE_TRAFFIC_INFO => $faultTypes,
            ]
        ));
    }

    /**
     * @param string[] $relatedLines
     * @param string[] $relatedStops
     * @param string[] $names
     *
     * @return TrafficInfoListResponse
     *
     * @throws InvalidResponseException
     */
    public function getTrafficInfoList(
        array $relatedLines = [],
        array $relatedStops = [],
        array $names = []
    ): TrafficInfoListResponse
    {
        return TrafficInfoListResponse::fromResponse($this->sendRequest(
            self::ACTION_NAME_TRAFFIC_INFO_LIST,
            [
                self::ACTION_PARAMETER_RELATED_LINE => $relatedLines,
                self::ACTION_PARAMETER_RELATED_STOP => $relatedStops,
                self::ACTION_PARAMETER_NAME         => $names,
            ]
        ));
    }

    /**
     * @param array $relatedLines
     * @param array $relatedStops
     * @param array $names
     *
     * @return NewsListResponse
     */
    public function getNewsList(
        array $relatedLines = [],
        array $relatedStops = [],
        array $names = []
    ): NewsListResponse
    {
        return NewsListResponse::fromResponse($this->sendRequest(
            self::ACTION_NAME_NEWS_LIST,
            [
                self::ACTION_PARAMETER_RELATED_LINE => $relatedLines,
                self::ACTION_PARAMETER_RELATED_STOP => $relatedStops,
                self::ACTION_PARAMETER_NAME         => $names,
            ]
        ));
    }

    //endregion

    //region Helper functions

    /**
     * Send the request.
     *
     * @param string $action
     * @param array $parameters
     *
     * @return array
     *
     * @throws InvalidResponseException
     */
    protected function sendRequest(string $action, array $parameters): array
    {
        $response = $this->getHttpClient()->sendRequest(
            $this->getMessageFactory()->createRequest(
                self::METHOD_GET,
                $this->buildUri($action, $parameters),
                [
                    'Accept=application/json',
                    'Content-Type=application/json'
                ]
            )
        );

        $responseContent = \json_decode($response->getBody()->getContents(), true);

        if (!(\is_array($responseContent) && !empty($responseContent[self::RESPONSE_PARAMETER_DATA]))) {
            throw new InvalidResponseException('Unknown response');
        }

        return $responseContent[self::RESPONSE_PARAMETER_DATA];
    }

    /**
     * Returns URI for the request.
     *
     * @param string $action
     * @param array  $parameters
     *
     * @return string
     */
    protected function buildUri(string $action, array $parameters): string
    {
        return $this->getApiEndpoint() . $action
            . '?' . self::ACTION_PARAMETER_SENDER . '=' . $this->getSenderId() . '&'
            . $this->createParameterString($parameters);
    }

    /**
     * Transforms the parameters into an URI parameter string.
     *
     * @param array       $parameters
     * @param string|null $numericPrefix
     *
     * @return string
     */
    protected function createParameterString(array $parameters, string $numericPrefix = null): string
    {
        return \implode(
            '&',
            \array_filter(
                \array_map(
                    function ($parameter, $key = null) use ($numericPrefix) {
                        if (empty($parameter)) {
                            return null;
                        }

                        if (\is_array($parameter) && !empty($parameter)) {
                            return $this->createParameterString($parameter, $key);
                        }

                        return (\is_numeric($key) ? $numericPrefix : $key) . '=' . $parameter;
                    },
                    $parameters,
                    \array_keys($parameters)
                ),
                function ($parameter) {
                    return !empty($parameter);
                }
            )
        );
    }

    //endregion
}