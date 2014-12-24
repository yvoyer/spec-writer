<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

use Star\SpecWriter\Keyword\Feature;
use Star\SpecWriter\Keyword\Given;
use Star\SpecWriter\Keyword\Goal;
use Star\SpecWriter\Keyword\Scenario;
use Star\SpecWriter\Keyword\Then;
use Star\SpecWriter\Keyword\When;

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
     * @var Feature
     */
    private $feature;

    /**
     * @var Scenario
     */
    private $currentScenario;

    public function __construct()
    {
        $this->startFeature('');
    }

    /**
     * @param string $title
     */
    public function startFeature($title)
    {
        $this->feature = new Feature($title);
    }

    /**
     * @param string $inOrder
     * @param string $asUser
     * @param string $description
     */
    public function inOrderTo($inOrder, $asUser, $description)
    {
        $this->feature->setGoal(new Goal($inOrder, $asUser, $description));
    }

    /**
     * @param string $title
     *
     * @return Scenario
     */
    public function startScenario($title)
    {
        $this->currentScenario = new Scenario($title);
        $this->feature->addScenario($this->currentScenario);
    }

    /**
     * @param string $given
     */
    public function addGiven($given)
    {
        $this->guardAgainstUndefinedScenario();
        $this->currentScenario->addGiven(new Given($given));
    }

    /**
     * @param string $when
     */
    public function addWhen($when)
    {
        $this->guardAgainstUndefinedScenario();
        $this->currentScenario->addWhen(new When($when));
    }

    /**
     * @param string $then
     */
    public function addThen($then)
    {
        $this->guardAgainstUndefinedScenario();
        $this->currentScenario->addThen(new Then($then));
    }

    /**
     * @return Scenario
     */
    public function endScenario()
    {
        $this->guardAgainstUndefinedScenario();
        $scenario = $this->currentScenario;
        $this->currentScenario = null;

        return $scenario;
    }

    /**
     * @return Feature
     */
    public function endFeature()
    {
        return $this->feature;
    }

    private function guardAgainstUndefinedScenario()
    {
        if (null === $this->currentScenario) {
            throw new \RuntimeException('The current scenario is not initialised.');
        }
    }
}
