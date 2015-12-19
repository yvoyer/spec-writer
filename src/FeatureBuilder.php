<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class FeatureBuilder
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class FeatureBuilder
{
    /**
     * @var Feature
     */
    private $feature;

    /**
     * @param string $header
     */
    public function __construct($header)
    {
        $this->feature = new Feature($header);
    }

    /**
     * @param string $description
     *
     * @return FeatureBuilder
     */
    public function asUser($description)
    {
        $this->feature->user = $description;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return FeatureBuilder
     */
    public function inOrderTo($description)
    {
        $this->feature->goal = $description;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return ScenarioBuilder
     */
    public function iNeedTo($description)
    {
        $this->feature->objective = $description;

        return new ScenarioBuilder($this->feature);
    }
}
