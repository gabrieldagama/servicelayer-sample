<?php

namespace GabrielGama\Vendor\Api\Data;

/**
 * Vendor interface.
 * @api
 */
interface VendorInterface
{
    
    const ID         = 'id';
    const NAME       = 'name';
    const IS_ACTIVE = 'is_active';
    
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get is_active
     *
     * @return bool
     */
    public function getIsActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return VendorInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return VendorInterface
     */
    public function setName($name);

    /**
     * Set creation time
     *
     * @param bool $isActive
     * @return VendorInterface
     */
    public function setIsActive($isActive);

}
