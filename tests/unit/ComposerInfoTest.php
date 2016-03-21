<?php

namespace Butterfly\Component\ComposerInfo\Tests;

use Butterfly\Component\ComposerInfo\ComposerInfo;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class ComposerInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstalledPackages()
    {
        $projectDir = __DIR__.'/data/prj1';

        $composerInfo = new ComposerInfo($projectDir);

        $packageInfos = $composerInfo->getInstalledPackagesInfo();

        $this->assertCount(52, $packageInfos);
        $this->assertInstanceOf('Butterfly\Component\ComposerInfo\PackageInfo', reset($packageInfos));
    }

    public function testGetInstalledPackagesIfFileNotReadable()
    {
        $projectDir = __DIR__.'/undefined';

        $composerInfo = new ComposerInfo($projectDir);

        $this->assertNull($composerInfo->getInstalledPackagesInfo());
    }
}
