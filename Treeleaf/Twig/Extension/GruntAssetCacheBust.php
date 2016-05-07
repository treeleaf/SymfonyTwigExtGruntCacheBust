<?php
namespace Treeleaf\Twig\Extension;

class GruntAssetCacheBust extends \Twig_Extension
{
    protected $fileCache = [];

    /**
     * @return string
     */
    public function getName()
    {
        return 'twig.gruntCacheBust';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            'gruntCacheBust'   => new \Twig_SimpleFunction('gruntCacheBust', [$this, 'gruntCacheBust'])
        ];
    }

    /**
     * @param string $jsonFile
     * @param string $cssFile
     * @return string
     */
    public function gruntCacheBust($jsonFile, $cssFile)
    {
        $jsonFile = $this->getFileContents($jsonFile);
        $map = json_decode($jsonFile, true);
        return isset($map[$cssFile]) ? $map[$cssFile] : $cssFile;
    }

    /**
     * @param string $file
     * @return string
     */
    protected function getFileContents($file)
    {
        if (! isset($this->fileCache[$file])) {
            $this->fileCache[$file] = file_get_contents($file);
        }
        return $this->fileCache[$file];
    }
}