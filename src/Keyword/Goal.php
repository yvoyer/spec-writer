<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Keyword;

/**
 * Class Goal
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Keyword
 */
final class Goal
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $inOrder;

    /**
     * @var string
     */
    private $asUser;

    /**
     * @var string
     */
    private $description;

    /**
     * @param string $inOrder
     * @param string $asUser
     * @param string $description
     */
    public function __construct($inOrder, $asUser, $description)
    {
        $this->asUser = $asUser;
        $this->description = $description;
        $this->inOrder = $inOrder;
    }

    /**
     * @return string
     */
    public function asUser()
    {
        return $this->asUser;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function inOrder()
    {
        return $this->inOrder;
    }
}
