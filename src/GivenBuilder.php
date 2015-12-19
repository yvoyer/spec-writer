<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class GivenBuilder
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
interface GivenBuilder
{
    /**
     * @param $description
     *
     * @return GivenBuilder|WhenBuilder
     */
    public function Given($description);
}
