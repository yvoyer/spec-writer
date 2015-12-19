<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class Feature
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class Feature
{
    /**
     * @var string
     */
    private $header;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $goal;

    /**
     * @var string
     */
    public $objective;

    /**
     * @param string $header
     */
    public function __construct($header)
    {
        $this->header = $header;
    }

    public function __toString()
    {
        return <<<STRING
Feature: {$this->header}
  As a {$this->user}
  In order {$this->goal}
  I need to {$this->objective}


STRING;
    }
}
