<?php

namespace GabrielGama\Vendor\Block;

use GabrielGama\Vendor\Api\Data\VendorInterface;
use GabrielGama\Vendor\Model\Vendor;
use GabrielGama\Vendor\Api\VendorRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class VendorList extends \Magento\Framework\View\Element\Template
{
   
    /**
     * @var VendorRepositoryInterface
     */
    protected $vendorRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    
    /**
     * @param Context $context
     * @param VendorRepositoryInterface $vendorRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        VendorRepositoryInterface $vendorRepository,
        array $data = []
    ) {
        $this->vendorRepository = $vendorRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Get Active Vendors
     * @return array
     */
    public function getActiveVendors()
    {
        $this->searchCriteriaBuilder->addFilter(
                VendorInterface::IS_ACTIVE,
                Vendor::ACTIVE
                );
        
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $vendorSearchResult = $this->vendorRepository->getList($searchCriteria);
        
        return $vendorSearchResult->getItems();
    }
    
}
