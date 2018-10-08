<?php

use SPie\WienerLinien\Response\DataObjects\PropertiesAttributes;

/**
 * Class PropertiesAttributesTest
 */
class PropertiesAttributesTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            PropertiesAttributes::class,
            new PropertiesAttributes($this->getFaker()->numberBetween())
        );
    }

    /**
     * @retrn void
     */
    public function testInvalidConstrct(): void
    {
        //empty rbl number
        try {
            new PropertiesAttributes();

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid rbl number
        try {
            new PropertiesAttributes($this->getFaker()->word);

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
            PropertiesAttributes::class,
            PropertiesAttributes::fromResponse([
                PropertiesAttributes::ATTRIBUTE_NAME_RBL_NUMBER => $this->getFaker()->numberBetween(),
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {
        //empty rbl number
        try {
            PropertiesAttributes::fromResponse([]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid rbl number
        try {
            PropertiesAttributes::fromResponse([
                PropertiesAttributes::ATTRIBUTE_NAME_RBL_NUMBER => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
