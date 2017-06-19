<?php

namespace GabrielGama\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Vendor model
 */
class Vendor extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('gabrielgama_vendor', 'id');
    }

}
