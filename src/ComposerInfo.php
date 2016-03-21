<?php

namespace Butterfly\Component\ComposerInfo;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class ComposerInfo
{
    /**
     * @var string
     */
    protected $projectDir;

    /**
     * @var PackageInfo[]
     */
    protected $installedPackages;

    /**
     * @param string $projectDir
     */
    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @return PackageInfo[]|null
     */
    public function getInstalledPackagesInfo()
    {
        if (null === $this->installedPackages) {
            $this->installedPackages = $this->parseInstalledPackages($this->projectDir . '/vendor/composer/installed.json');
        }

        return $this->installedPackages;
    }

    /**
     * @param string $installedFilepath
     * @return array|null
     */
    public function parseInstalledPackages($installedFilepath)
    {
        if (!is_readable($installedFilepath)) {
            return null;
        }

        $installedData = $this->parseJsonFile($installedFilepath);

        $installedPackages = array();

        foreach ($installedData as $installedDataOfPackage) {
            $packageInfo = new PackageInfo($installedDataOfPackage);
            $installedPackages[$packageInfo->getName()] = $packageInfo;
        }


        return $installedPackages;
    }

    /**
     * @param string $file
     * @return array
     */
    protected function parseJsonFile($file)
    {
        return json_decode(file_get_contents($file), true);
    }
}
