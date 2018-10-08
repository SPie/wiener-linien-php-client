<?php

use SPie\WienerLinien\Response\DataObjects\Properties;

/**
 * Class PropertiesTest
 */
class PropertiesTest extends TestCase
{

    //region Tests

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            Properties::class,
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            )
        );
    }

    /**
     * @return void
     */
    public function testConstructOnlyRequired(): void
    {
        $this->assertInstanceOf(
            Properties::class,
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->createPropertyAttributes()
            )
        );
    }

    public function testInvalidConstruct(): void
    {
        //empty name
        try {
            new Properties(
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            new Properties(
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            new Properties(
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty municipality
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid municipality
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty municipality id
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid municipality id
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->word,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                null,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty coordinate name
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                null,
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid coordinate name
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid gate
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->createPropertyAttributes()
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty attributes
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                null
            );

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid attributes
        try {
            new Properties(
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->numberBetween(),
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
                $this->getFaker()->uuid,
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
            Properties::class,
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ])
        );
    }

    /**
     * @return void
     */
    public function testInvalidFromResponse(): void
    {
        //empty name
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid name
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty title
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid title
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty municipality
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid municipality
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty municipality id
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid municipality id
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->word,
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty type
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid type
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty coordinate name
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid coordinate name
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid gate
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->createPropertyAttributesArray(),
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //empty attributes
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }

        //invalid attributes
        try {
            Properties::fromResponse([
                Properties::ATTRIBUTE_NAME_NAME            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_TITLE           => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY    => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_MUNICIPALITY_ID => $this->getFaker()->numberBetween(),
                Properties::ATTRIBUTE_NAME_TYPE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_COORDINATE_NAME => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_GATE            => $this->getFaker()->uuid,
                Properties::ATTRIBUTE_NAME_ATTRIBUTES      => $this->getFaker()->word,
            ]);

            $this->assertTrue(false);
        } catch (Throwable $t) {
            $this->assertTrue(true);
        }
    }

    //endregion
}
