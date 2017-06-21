<?php

namespace GabrielGama\Vendor\Api;

/**
 * @api
 */
interface VendorManagementInterface
{
    
    /**
     * Activate
     *
     * @param int $id
     * @return \GabrielGama\Vendor\Api\Data\VendorInterface
     */
    public function activate($id);
    
    /**
     * Activate
     *
     * @param int $id
     * @return \GabrielGama\Vendor\Api\Data\VendorInterface
     */
    public function deactivate($id);
}
