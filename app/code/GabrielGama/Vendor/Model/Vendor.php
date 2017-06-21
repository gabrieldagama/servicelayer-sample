<?php

namespace GabrielGama\Vendor\Model;

use GabrielGama\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Vendor model
 */
class Vendor extends AbstractModel implements VendorInterface
{
    const ACTIVE = 1;
    
    const NOT_ACTIVE = 0;
    
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\GabrielGama\Vendor\Model\ResourceModel\Vendor::class);
    }

    /**
     * Retrieve vendor id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve vendor name
     *
     * @return string
     */
    public function getName()
    {
        return (string)$this->getData(self::NAME);
    }

    /**
     * Retrieve vendor is_active
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }
    /**
     * Set ID
     *
     * @param int $id
     * @return VendorInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return VendorInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set creation time
     *
     * @param bool $isActive
     * @return VendorInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

}
