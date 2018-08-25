<?php

namespace Butterfly\Component\ComposerInfo;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class PackageInfo
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var PackageVersion
     */
    protected $version;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * @return string
     */
    public function getLicense()
    {
        if(!\key_exists('license', $this->data))
            return null;
        
        return $this->data['license'];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        if(!\key_exists('description', $this->data))
            return null;
        
        return $this->data['description'];
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        if(!\key_exists('homepage', $this->data))
            return null;
        
        return $this->data['homepage'];
    }

    /**
     * @return object
     */
    public function getRawData()
    {   
        return $this->data;
    }

    /**
     * @return string
     */
    public function getRawVersion()
    {
        return $this->data['version'];
    }

    /**
     * @return PackageVersion
     */
    public function getVersion()
    {
        if (null === $this->version) {
            $this->version = new PackageVersion($this->data['version_normalized']);
        }

        return $this->version;
    }
}
