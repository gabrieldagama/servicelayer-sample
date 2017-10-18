<?php

namespace GabrielGama\Vendor\Model\ResourceModel\Vendor;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Vendor Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
                \GabrielGama\Vendor\Model\Vendor::class,
                \GabrielGama\Vendor\Model\ResourceModel\Vendor::class
                );
    }
}
