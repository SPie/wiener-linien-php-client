<?php

namespace SPie\WienerLinien\Response;

use SPie\WienerLinien\Response\DataObjects\Poi;
use SPie\WienerLinien\Response\DataObjects\PoiCategory;
use SPie\WienerLinien\Response\DataObjects\PoiCategoryGroup;

/**
 * Class NewsListResponse
 *
 * @package SPie\WienerLinien\Response
 */
class NewsListResponse extends Response
{

    const ATTRIBUTE_NAME_POI_CATEGORY_GROUPS = 'poiCategoryGroups';
    const ATTRIBUTE_NAME_POI_CATEGORIES      = 'poiCategories';
    const ATTRIBUTE_NAME_POIS                = 'pois';

    /**
     * @var PoiCategoryGroup[]
     */
    private $poiCategoryGroups;

    /**
     * @var PoiCategory[]
     */
    private $poiCategories;

    /**
     * @var Poi[]
     */
    private $pois;

    /**
     * NewsListResponse constructor.
     *
     * @param PoiCategoryGroup[] $poiCategoryGroups
     * @param PoiCategory[]      $poiCategories
     * @param Poi[]              $pois
     */
    public function __construct(array $poiCategoryGroups, array $poiCategories, array $pois)
    {
        $this->poiCategoryGroups = $poiCategoryGroups;
        $this->poiCategories     = $poiCategories;
        $this->pois              = $pois;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromResponse(array $response)
    {
        $data = $response[self::ATTRIBUTE_NAME_DATA] ?? [];

        return new self(
            !empty($data[self::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS])
                ? \array_map(
                    function (array $poiCategoryGroup) {
                        return PoiCategoryGroup::fromResponse($poiCategoryGroup);
                    },
                    $data[self::ATTRIBUTE_NAME_POI_CATEGORY_GROUPS]
                )
                : [],
            !empty($data[self::ATTRIBUTE_NAME_POI_CATEGORIES])
                ? \array_map(
                    function (array $poiCategory) {
                        return PoiCategory::fromResponse($poiCategory);
                    },
                    $data[self::ATTRIBUTE_NAME_POI_CATEGORIES]
                )
                : [],
            !empty($data[self::ATTRIBUTE_NAME_POIS])
                ? \array_map(
                    function (array $poi) {
                        return Poi::fromResponse($poi);
                    },
                    $data[self::ATTRIBUTE_NAME_POIS]
                )
                : []
        );
    }
}