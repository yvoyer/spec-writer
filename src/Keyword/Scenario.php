<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Keyword;

use Star\Component\Collection\TypedCollection;

/**
 * Class Scenario
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Keyword
 */
final class Scenario
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var TypedCollection|Given[]
     */
    private $givens;

    /**
     * @var TypedCollection|When[]
     */
    private $whens;

    /**
     * @var TypedCollection|Then[]
     */
    private $thens;

    /**
     * @var string
     */
    private $title;

    /**
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->givens = new TypedCollection(Given::CLASS_NAME);
        $this->whens = new TypedCollection(When::CLASS_NAME);
        $this->thens = new TypedCollection(Then::CLASS_NAME);
    }

    /**
     * @param Given $given
     */
    public function addGiven(Given $given)
    {
        $this->givens->add($given);
    }

    /**
     * @return Given[]
     */
    public function givens()
    {
        return $this->givens->toArray();
    }

    /**
     * @param When $when
     */
    public function addWhen(When $when)
    {
        $this->whens->add($when);
    }

    /**
     * @return When[]
     */
    public function whens()
    {
        return $this->whens->toArray();
    }

    /**
     * @param Then $then
     */
    public function addThen(Then $then)
    {
        $this->thens->add($then);
    }

    /**
     * @return Then[]
     */
    public function thens()
    {
        return $this->thens->toArray();
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }
}
