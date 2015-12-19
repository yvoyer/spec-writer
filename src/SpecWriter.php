<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class SpecWriter
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter
 */
class SpecWriter
{
    /**
     * @param string $description
     *
     * @return FeatureBuilder
     */
    public static function feature($description)
    {
        return new FeatureBuilder($description);
    }
}
