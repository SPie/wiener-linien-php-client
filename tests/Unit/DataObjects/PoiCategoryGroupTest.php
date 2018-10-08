<?php

use SPie\WienerLinien\Response\DataObjects\PoiCategoryGroup;

/**
 * Class PoiCategoryGroupTest
 */
class PoiCategoryGroupTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            PoiCategoryGroup::class,
            new PoiCategoryGroup(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            PoiCategoryGroup::class,
            new PoiCategoryGroup(
                null,
                $this->getFaker()->numberBetween(),
                null
            )
        );
    }

    /**
     * @return void
     */
    public function testInvalidConstruct(): void
    {
        //invalid name
        try {
            new PoiCategoryGroup(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty id
        try {
            new PoiCategoryGroup(
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            new PoiCategoryGroup(
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->uuid
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            new PoiCategoryGroup(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
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
            PoiCategoryGroup::class,
            PoiCategoryGroup::fromResponse([
                PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->uuid,
                PoiCategoryGroup::ATTRIBUTE_NAME_ID    => $this->getFaker()->numberBetween(),
                PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //invalid name
        try {
            PoiCategoryGroup::fromResponse([
                PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->numberBetween(),
                PoiCategoryGroup::ATTRIBUTE_NAME_ID    => $this->getFaker()->numberBetween(),
                PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty id
        try {
            PoiCategoryGroup::fromResponse([
                PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->uuid,
                PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            PoiCategoryGroup::fromResponse([
                PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->uuid,
                PoiCategoryGroup::ATTRIBUTE_NAME_ID    => $this->getFaker()->word,
                PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            PoiCategoryGroup::fromResponse([
                PoiCategoryGroup::ATTRIBUTE_NAME_NAME  => $this->getFaker()->uuid,
                PoiCategoryGroup::ATTRIBUTE_NAME_ID    => $this->getFaker()->numberBetween(),
                PoiCategoryGroup::ATTRIBUTE_NAME_TITLE => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
