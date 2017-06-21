<?php

namespace GabrielGama\Vendor\Model;

use GabrielGama\Vendor\Api\VendorManagementInterface;
use GabrielGama\Vendor\Api\VendorRepositoryInterface;
use GabrielGama\Vendor\Api\Data\VendorInterface;
use GabrielGama\Vendor\Model\Vendor;
/**
 * Class VendorManagement
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class VendorManagement implements VendorManagementInterface
{

    /**
     * @var VendorRepositoryInterface
     */
    protected $vendorRepository;

    /**
     * @param VendorRepositoryInterface $vendorRepository
     */
    public function __construct(
        VendorRepositoryInterface $vendorRepository
    ) {
        $this->vendorRepository = $vendorRepository;
    }
    
    /**
     * Activate vendor
     * @param int $id
     * @return VendorInterface
     */
    public function activate($id) {
        $vendor = $this->vendorRepository->get($id);
        $vendor->setIsActive(Vendor::ACTIVE);
        return $this->vendorRepository->save($vendor);
    }

    /**
     * Deactivate vendor
     * @param int $id
     * @return VendorInterface
     */
    public function deactivate($id) {
        $vendor = $this->vendorRepository->get($id);
        $vendor->setIsActive(Vendor::NOT_ACTIVE);
        return $this->vendorRepository->save($vendor);
    }

}
