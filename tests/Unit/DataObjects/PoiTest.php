<?php

use SPie\WienerLinien\Response\DataObjects\Poi;

/**
 * Class PoiTest
 */
class PoiTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Poi::class,
            new Poi(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->dateTime,
                $this->getFaker()->dateTime,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                [
                    $this->getFaker()->uuid
                ],
                [
                    $this->getFaker()->uuid
                ],
                [
                    $this->getFaker()->uuid
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            Poi::class,
            new Poi(
                $this->getFaker()->numberBetween(),
                null,
                null,
                null,
                $this->getFaker()->uuid,
                null,
                null,
                [
                    $this->getFaker()->uuid
                ],
                [
                    $this->getFaker()->uuid
                ],
                [
                    $this->getFaker()->uuid
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testFromResponse(): void
    {
        $this->assertInstanceOf(
            Poi::class,
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty ref poi category id
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref poi category id
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->word,
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid start
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->word,
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid end
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->word,
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid subtitle
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid description
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related lines
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related lines
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => $this->getFaker()->word,
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty related stops
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid related stops
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => $this->getFaker()->word,
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty attributes
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid attributes
        try {
            Poi::fromResponse([
                Poi::ATTRIBUTE_NAME_REF_POI_CATEGORY_ID => $this->getFaker()->numberBetween(),
                Poi::ATTRIBUTE_NAME_NAME => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_START => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_END => $this->getFaker()->dateTime->getTimestamp() . 'xxx',
                Poi::ATTRIBUTE_NAME_TITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_SUBTITLE => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_DESCRIPTION => $this->getFaker()->uuid,
                Poi::ATTRIBUTE_NAME_RELATED_LINES => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_RELATED_STOPS => [
                    $this->getFaker()->uuid,
                ],
                Poi::ATTRIBUTE_NAME_ATTRIBUTES => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
