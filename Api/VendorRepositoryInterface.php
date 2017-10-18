<?php

namespace GabrielGama\Vendor\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Vendor CRUD interface.
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * Save vendor.
     *
     * @param \GabrielGama\Vendor\Api\Data\VendorInterface $vendor
     * @return \GabrielGama\Vendor\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\VendorInterface  $vendor);

    /**
     * Retrieve vendor.
     *
     * @param int $id
     * @return \GabrielGama\Vendor\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve vendors matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \GabrielGama\Vendor\Api\Data\VendorSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Delete vendor.
     *
     * @param \GabrielGama\Vendor\Api\Data\VendorInterface $vendor
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\VendorInterface $vendor);

    /**
     * Delete vendor by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
