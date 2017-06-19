<?php

namespace GabrielGama\Vendor\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for vendor search results.
 * @api
 */
interface VendorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get vendor list.
     *
     * @return \GabrielGama\Vendor\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set vendor list.
     *
     * @param \GabrielGama\Vendor\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
