<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Keyword;

use Star\Component\Collection\TypedCollection;

/**
 * Class Feature
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Keyword
 */
class Feature
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Goal
     */
    private $goal;

    /**
     * @var TypedCollection|Scenario[]
     */
    private $scenarios;

    /**
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->scenarios = new TypedCollection(Scenario::CLASS_NAME);
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @param Goal $goal
     */
    public function setGoal(Goal $goal)
    {
        $this->goal = $goal;
    }

    /**
     * @return Goal
     */
    public function goal()
    {
        return $this->goal;
    }

    /**
     * @param Scenario $scenario
     */
    public function addScenario(Scenario $scenario)
    {
        $this->scenarios->add($scenario);
    }
}
