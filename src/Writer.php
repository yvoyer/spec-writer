<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class Writer
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
interface Writer
{
    /**
     * @param string $filepath
     */
    public function write($filepath);
}
