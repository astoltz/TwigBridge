<?php
namespace TwigBridge\Twig\Loader;

use Twig_LoaderInterface;
use Twig_ExistsLoaderInterface;

class PathLoader implements Twig_LoaderInterface, Twig_ExistsLoaderInterface
{


    protected function findTemplate($name){
        return realpath($name);
    }
    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        return file_get_contents( $this->findTemplate($name) );
    }

    /**
     * {@inheritdoc}
     */
    public function exists($name)
    {
        return is_file($this->findTemplate($name));
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        return $this->findTemplate($name);
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return filemtime( $this->findTemplate($name) ) <= $time;
    }
}