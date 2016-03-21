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
