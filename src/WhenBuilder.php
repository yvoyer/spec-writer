<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class WhenBuilder
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
interface WhenBuilder
{
    /**
     * @param $description
     *
     * @return WhenBuilder|ThenBuilder
     */
    public function When($description);
}
