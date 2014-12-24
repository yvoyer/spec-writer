<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Dumper;

/**
 * Class Dumper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Dumper
 */
interface Dumper
{
    const INTERFACE_NAME = __CLASS__;

    /**
     *
     * @return string
     */
    public function dump();
}
