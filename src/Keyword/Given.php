<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Keyword;

/**
 * Class Given
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter\Keyword
 */
final class Given
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $statement;

    /**
     * @param string $statement
     */
    public function __construct($statement)
    {
        $this->statement = $statement;
    }

    /**
     * @return string
     */
    public function statement()
    {
        return $this->statement;
    }
}
