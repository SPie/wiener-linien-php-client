<?php

use SPie\WienerLinien\Response\DataObjects\PoiCategory;

/**
 * Class PoiCategoryTest
 */
class PoiCategoryTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            PoiCategory::class,
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            PoiCategory::class,
            new PoiCategory(
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //invalid name
        try {
            new PoiCategory(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty id
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->numberBetween()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref poi category group id
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref poi category group id
        try {
            new PoiCategory(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
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
            PoiCategory::class,
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ])
        );
    }

    public function testInvalidFromResponse(): void
    {
        //invalid name
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty id
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid id
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->word,
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty ref poi category group id
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid ref poi category group id
        try {
            PoiCategory::fromResponse([
                PoiCategory::ATTRIBUTE_NAME_NAME                      => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_TITLE                     => $this->getFaker()->uuid,
                PoiCategory::ATTRIBUTE_NAME_ID                        => $this->getFaker()->numberBetween(),
                PoiCategory::ATTRIBUTE_NAME_REF_POI_CATEGORY_GROUP_ID => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
