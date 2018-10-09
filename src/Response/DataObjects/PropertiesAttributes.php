<?php

namespace SPie\WienerLinien\Response\DataObjects;

use SPie\WienerLinien\Response\ResponseObjectInterface;

/**
 * Class PropertyAttributes
 *
 * @package SPie\WienerLinien\Response
 */
final class PropertiesAttributes implements ResponseObjectInterface
{

    const ATTRIBUTE_NAME_RBL_NUMBER = 'rbl';

    /**
     * @var int
     */
    private $rblNumber;

    /**
     * PropertiesAttributes constructor.
     *
     * @param int $rblNumber
     */
    public function __construct(int $rblNumber)
    {
        $this->rblNumber = $rblNumber;
    }

    /**
     * @return int
     */
    public function getRblNumber(): int
    {
        return $this->rblNumber;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        return new self($response[self::ATTRIBUTE_NAME_RBL_NUMBER] ?? null);
    }
}
