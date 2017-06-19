<?php

namespace GabrielGama\Vendor\Model;

use GabrielGama\Vendor\Api\VendorRepositoryInterface;
use GabrielGama\Vendor\Model\ResourceModel\Vendor as ResourceVendor;
use GabrielGama\Vendor\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use GabrielGama\Vendor\Api\Data\VendorSearchResultsInterfaceFactory;
use GabrielGama\Vendor\Api\Data\VendorInterfaceFactory;
use GabrielGama\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Class VendorRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @var ResourceVendor
     */
    protected $resource;

    /**
     * @var VendorFactory
     */
    protected $vendorFactory;

    /**
     * @var VendorCollectionFactory
     */
    protected $vendorCollectionFactory;

    /**
     * @var VendorSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var VendorInterfaceFactory
     */
    protected $dataVendorFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceVendor $resource
     * @param VendorFactory $vendorFactory
     * @param VendorInterfaceFactory $dataVendorFactory
     * @param VendorCollectionFactory $vendorCollectionFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceVendor $resource,
        VendorFactory $vendorFactory,
        VendorInterfaceFactory $dataVendorFactory,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->vendorFactory = $vendorFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataVendorFactory = $dataVendorFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save vendor data
     *
     * @param \GabrielGama\Vendor\Api\Data\VendorInterface $vendor
     * @return Vendor
     * @throws CouldNotSaveException
     */
    public function save(VendorInterface $vendor)
    {
        try {
            $this->resource->save($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $vendor;
    }

    /**
     * Load vendor
     *
     * @param string $id
     * @return Vendor
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id)
    {
        $vendor = $this->vendorFactory->create();
        $this->resource->load($vendor, $id);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Vendor with id "%1" does not exist.', $id));
        }
        return $vendor;
    }

    /**
     * Load Vendor data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \GabrielGama\Vendor\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $collection = $this->vendorCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $vendors = [];
        /** @var Vendor $model */
        foreach ($collection as $model) {
            $vendorData = $this->dataVendorFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $vendorData,
                $model->getData(),
                \GabrielGama\Vendor\Api\Data\VendorInterface::class
            );
            $vendors[] = $this->dataObjectProcessor->buildOutputDataArray(
                $vendorData,
                \GabrielGama\Vendor\Api\Data\VendorInterface::class
            );
        }

        /** @var VendorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($vendors);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Vendor
     *
     * @param \GabrielGama\Vendor\Api\Data\VendorInterface $vendor
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(VendorInterface $vendor)
    {
        try {
            $this->resource->delete($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Vendor by given Vendor Id
     *
     * @param string $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

}
