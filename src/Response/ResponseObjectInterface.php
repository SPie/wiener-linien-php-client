<?php

namespace SPie\WienerLinien\Response;

/**
 * Interface ResponseObjectInterface
 *
 * @package SPie\WienerLinien\Response
 */
interface ResponseObjectInterface
{

    const ATTRIBUTE_NAME_DATA = 'data';

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response);

}
