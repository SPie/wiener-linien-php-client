<?php

use SPie\WienerLinien\Response\ResponseMessage;

/**
 * Class ResponseMessageTest
 */
class ResponseMessageTest extends TestCase
{

    //region Tests

    /**
     * @retrn void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            ResponseMessage::class,
            new ResponseMessage(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->dateTime
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //empty value
        try {
            new ResponseMessage(
                null,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid value
        try {
            new ResponseMessage(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty message code
        try {
            new ResponseMessage(
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid message code
        try {
            new ResponseMessage(
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->dateTime
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty server time
        try {
            new ResponseMessage(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid server time
        try {
            new ResponseMessage(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
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
            ResponseMessage::class,
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {
        //empty value
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid value
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->numberBetween(),
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty message code
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid message code
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->word,
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->dateTime->format('Y-m-d H:i:s'),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty server time
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid server time
        try {
            ResponseMessage::fromResponse([
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_VALUE => $this->getFaker()->uuid,
                ResponseMessage::ATTRIBUTE_NAME_MESSAGE_CODE  => $this->getFaker()->numberBetween(),
                ResponseMessage::ATTRIBUTE_NAME_SERVER_TIME   => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
