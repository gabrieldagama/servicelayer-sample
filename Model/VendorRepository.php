<?php

namespace GabrielGama\Vendor\Model;

use GabrielGama\Vendor\Api\VendorRepositoryInterface;
use GabrielGama\Vendor\Model\ResourceModel\Vendor as ResourceVendor;
use GabrielGama\Vendor\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use GabrielGama\Vendor\Api\Data\VendorSearchResultsInterfaceFactory;
use GabrielGama\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaFactory;
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
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    
    /**
     * @var SearchCriteriaFactory 
     */
    private $searchCriteriaFactory;

    /**
     * @param ResourceVendor $resource
     * @param VendorFactory $vendorFactory
     * @param VendorCollectionFactory $vendorCollectionFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchCriteriaFactory $searchCriteriaFactory
     */
    public function __construct(
        ResourceVendor $resource,
        VendorFactory $vendorFactory,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaFactory $searchCriteriaFactory
    ) {
        $this->resource = $resource;
        $this->vendorFactory = $vendorFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchCriteriaFactory = $searchCriteriaFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
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
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $criteria
     * @return \GabrielGama\Vendor\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria = null)
    {
        $collection = $this->vendorCollectionFactory->create();
        
        if (is_null($criteria)) {
            $criteria = $this->searchCriteriaFactory->create();
        }
        
        $this->collectionProcessor->process($criteria, $collection);
            
        /** @var VendorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
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
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

}
