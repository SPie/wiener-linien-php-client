<?php

namespace SPie\WienerLinien\Response;

/**
 * Interface ResponseObjectInterface
 *
 * @package SPie\WienerLinien\Response
 */
interface ResponseObjectInterface
{

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response);

}