<?php

namespace Butterfly\Component\ComposerInfo\Tests;

use Butterfly\Component\ComposerInfo\PackageInfo;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class PackageInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected static $twigConfigExample = array(
        'name'                => 'twig/twig',
        'version'             => 'v1.23.1',
        'version_normalized'  => '1.23.1.0',
        'source'              =>
            array(
                'type'      => 'git',
                'url'       => 'https://github.com/twigphp/Twig.git',
                'reference' => 'd9b6333ae8dd2c8e3fd256e127548def0bc614c6',
            ),
        'dist'                =>
            array(
                'type'      => 'zip',
                'url'       => 'https://api.github.com/repos/twigphp/Twig/zipball/d9b6333ae8dd2c8e3fd256e127548def0bc614c6',
                'reference' => 'd9b6333ae8dd2c8e3fd256e127548def0bc614c6',
                'shasum'    => '',
            ),
        'require'             =>
            array(
                'php' => '>=5.2.7',
            ),
        'require-dev'         =>
            array(
                'symfony/debug'          => '~2.7',
                'symfony/phpunit-bridge' => '~2.7',
            ),
        'time'                => '2015-11-05 12:49:06',
        'type'                => 'library',
        'extra'               =>
            array(
                'branch-alias' =>
                    array(
                        'dev-master' => '1.23-dev',
                    ),
            ),
        'installation-source' => 'dist',
        'autoload'            =>
            array(
                'psr-0' =>
                    array(
                        'Twig_' => 'lib/',
                    ),
            ),
        'notification-url'    => 'https://packagist.org/downloads/',
        'license'             =>
            array(
                0 => 'BSD-3-Clause',
            ),
        'authors'             =>
            array(
                0 =>
                    array(
                        'name'     => 'Fabien Potencier',
                        'email'    => 'fabien@symfony.com',
                        'homepage' => 'http://fabien.potencier.org',
                        'role'     => 'Lead Developer',
                    ),
                1 =>
                    array(
                        'name'  => 'Armin Ronacher',
                        'email' => 'armin.ronacher@active-4.com',
                        'role'  => 'Project Founder',
                    ),
                2 =>
                    array(
                        'name'     => 'Twig Team',
                        'homepage' => 'http://twig.sensiolabs.org/contributors',
                        'role'     => 'Contributors',
                    ),
            ),
        'description'         => 'Twig, the flexible, fast, and secure template language for PHP',
        'homepage'            => 'http://twig.sensiolabs.org',
        'keywords'            =>
            array(
                0 => 'templating',
            ),
    );

    public function testGetName()
    {
        $packageInfo = $this->getPackageInfo();

        $this->assertEquals(self::$twigConfigExample['name'], $packageInfo->getName());
    }

    public function testGetRawVersion()
    {
        $packageInfo = $this->getPackageInfo();

        $this->assertEquals('v1.23.1', $packageInfo->getRawVersion());
    }

    public function testGetVersion()
    {
        $packageInfo = $this->getPackageInfo();

        $this->assertInstanceOf('Butterfly\Component\ComposerInfo\PackageVersion', $packageInfo->getVersion());
    }

    /**
     * @return PackageInfo
     */
    protected function getPackageInfo()
    {
        return new PackageInfo(self::$twigConfigExample);
    }
}
