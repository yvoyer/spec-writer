<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class ThenBuilder
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
interface ThenBuilder
{
    /**
     * @param $description
     *
     * @return ThenBuilder
     */
    public function Then($description);

    /**
     * @return ScenarioBuilder|Writer
     */
    public function endScenario();
}
