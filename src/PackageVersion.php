<?php

namespace Butterfly\Component\ComposerInfo;

/**
 * @author Marat Fakhertdinov <marat.fakhertdinov@gmail.com>
 */
class PackageVersion
{
    const MAJOR = 'major';
    const MINOR = 'minor';
    const REVISION = 'revision';
    const BUILD = 'build';

    /**
     * @var array
     */
    protected static $orderedCodes = array(
        self::MAJOR,
        self::MINOR,
        self::REVISION,
        self::BUILD,
    );

    /**
     * @var string
     */
    protected $normalized;

    /**
     * @var array
     */
    protected $byCodes;

    /**
     * @param string $normalized (major.minor.revision.build)
     */
    public function __construct($normalized)
    {
        $this->normalized = $normalized;
        $this->byCodes    = $this->parse($normalized);
    }

    /**
     * @param string $normalizedVersion
     *
     * @return array
     */
    protected function parse($normalizedVersion)
    {
        $rawValues = explode('.', $normalizedVersion);

        $values = array();

        $orderedNumber = 0;

        foreach (self::$orderedCodes as $code) {
            $values[$code] = array_key_exists($orderedNumber, $rawValues) ? (int)$rawValues[$orderedNumber] : 0;
            $orderedNumber++;
        }

        return $values;
    }

    /**
     * @return string
     */
    public function getNormalized()
    {
        return $this->normalized;
    }

    /**
     * @param string $code
     * @return int
     * @throws \InvalidArgumentException if undefined code of version
     */
    public function getByCode($code)
    {
        if (!array_key_exists($code, $this->byCodes)) {
            throw new \InvalidArgumentException('Undefined code of version');
        }

        return $this->byCodes[$code];
    }

    /**
     * @return int
     */
    public function getMajor()
    {
        return $this->getByCode(self::MAJOR);
    }

    /**
     * @return int
     */
    public function getMinor()
    {
        return $this->getByCode(self::MINOR);
    }

    /**
     * @return int
     */
    public function getRevision()
    {
        return $this->getByCode(self::REVISION);
    }

    /**
     * @return int
     */
    public function getBuild()
    {
        return $this->getByCode(self::BUILD);
    }

    /**
     * @param string $compareVersion
     * @return bool
     */
    public function is($compareVersion)
    {
        if ($this->normalized == $compareVersion) {
            return true;
        }

        $compareCodes = $this->parse($compareVersion);

        $codes = array(
            self::MAJOR,
            self::MINOR,
            self::REVISION,
            self::BUILD,
        );

        foreach ($codes as $code) {
            if ('*' == $compareCodes[$code]) {
                return true;
            }

            if ($this->getByCode($code) !== $compareCodes[$code]) {
                return false;
            }
        }

        return false;
    }
}
