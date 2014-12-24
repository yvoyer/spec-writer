<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Dumper;

/**
 * Class FeatureDumper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Dumper
 */
final class FeatureDumper implements Dumper
{
    const CLASS_NAME = __CLASS__;

    /**
     *
     * @return string
     */
    public function dump()
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
