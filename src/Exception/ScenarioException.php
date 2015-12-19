<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter\Exception;

/**
 * Class ScenarioException
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class ScenarioException extends \Exception
{
    /**
     * @param string $type
     * @param array $variables
     *
     * @return ScenarioException
     */
    public static function invalidVariableCountInStatement($type, array $variables) {
        $vars = implode(',', $variables);
        return new ScenarioException("The variables '[{$vars}]' were not initialized before adding another '{$type}'.");
    }
}
