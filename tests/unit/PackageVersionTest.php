<?php

namespace Butterfly\Component\ComposerInfo\Tests;

use Butterfly\Component\ComposerInfo\PackageVersion;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class PackageVersionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNormalized()
    {
        $version = new PackageVersion('1.2.3.4');

        $this->assertEquals('1.2.3.4', $version->getNormalized());
    }

    public function testGetMajor()
    {
        $version = new PackageVersion('1.2.3.4');

        $this->assertInternalType('int', $version->getMajor());
        $this->assertEquals(1, $version->getMajor());

        $this->assertInternalType('int', $version->getByCode(PackageVersion::MAJOR));
        $this->assertEquals(1, $version->getByCode(PackageVersion::MAJOR));
    }

    public function testGetMinor()
    {
        $version = new PackageVersion('1.2.3.4');

        $this->assertInternalType('int', $version->getMinor());
        $this->assertEquals(2, $version->getMinor());

        $this->assertInternalType('int', $version->getByCode(PackageVersion::MINOR));
        $this->assertEquals(2, $version->getByCode(PackageVersion::MINOR));
    }

    public function testGetRevision()
    {
        $version = new PackageVersion('1.2.3.4');

        $this->assertInternalType('int', $version->getRevision());
        $this->assertEquals(3, $version->getRevision());

        $this->assertInternalType('int', $version->getByCode(PackageVersion::REVISION));
        $this->assertEquals(3, $version->getByCode(PackageVersion::REVISION));
    }

    public function testGetBuild()
    {
        $version = new PackageVersion('1.2.3.4');

        $this->assertInternalType('int', $version->getBuild());
        $this->assertEquals(4, $version->getBuild());

        $this->assertInternalType('int', $version->getByCode(PackageVersion::BUILD));
        $this->assertEquals(4, $version->getByCode(PackageVersion::BUILD));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetByCodeIfUndefinedCode()
    {
        $version = new PackageVersion('1.2.3.4');

        $version->getByCode('undefined');
    }

    public function getDataForTestIsVersion()
    {
        return array(
            array('1.2.3.4', '1.2.3.4', true),
            array('1.2.3.4', '1.2.3.5', false),

            array('1.2.3.4', '1.2.3.*', true),
            array('1.2.3.4', '1.2.*.*', true),
            array('1.2.3.4', '1.*.*.*', true),
            array('1.2.3.4', '*.*.*.*', true),

            array('1.2.3.4', '1.2.3.*', true),
            array('1.2.3.4', '1.2.*', true),
            array('1.2.3.4', '1.*', true),
            array('1.2.3.4', '*', true),

            array('1.2.3.4', '1.2.3', true),
            array('1.2.3.4', '1.2', true),
            array('1.2.3.4', '1', true),

            array('1.2.3.4', '*.2.3.4', true),
        );
    }

    /**
     * @dataProvider getDataForTestIsVersion
     * @param string $version
     * @param string $compareVersion
     * @param bool $expectedResult
     */
    public function testIsVersion($version, $compareVersion, $expectedResult)
    {
        $version = new PackageVersion($version);

        $this->assertEquals($expectedResult, $version->is($compareVersion));
    }
}
