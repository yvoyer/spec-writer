<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

use Star\SpecWriter\Exception\ScenarioException;

/**
 * Class Scenario
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class Scenario
{
    /**
     * @var array
     */
    private $statements = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     * @param array $values List of values to replace the variables with.
     */
    public function andGiven($description, array $values = [])
    {
        $this->addStatement('Given', $description, $values);
    }

    /**
     * @param string $description
     * @param array $values List of values to replace the variables with.
     */
    public function andWhen($description, array $values = [])
    {
        $this->addStatement('When', $description, $values);
    }

    /**
     * @param string $description
     * @param array $values List of values to replace the variables with.
     */
    public function andThen($description, array $values = [])
    {
        $this->addStatement('Then', $description, $values);
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public function extractVariables($string)
    {
        $variables = explode(' ', $string);
        foreach ($variables as $key => $variable) {
            if (0 !== strpos($variable, ':')) {
                unset($variables[$key]);
            }
        }

        return array_values($variables);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $scenario = <<<NAME
  Scenario: {$this->name}

NAME;
        foreach ($this->statements as $type => $statements) {
            $multi = (count($statements) > 1);
            foreach ($statements as $index => $given) {
                $keyword = $type;
                if ($multi && $index > 0) {
                    $keyword = 'And';
                }
                $scenario .= <<<LINE
    {$keyword} {$given}

LINE;
            }
        }

        return $scenario . <<<EOL


EOL;
    }

    /**
     * @param string $type
     * @param string $description
     * @param array $values The values to replace the variable with
     */
    private function addStatement($type, $description, array $values)
    {
        $variables = $this->extractVariables($description);
        $this->guardAgainstMissingParameters($type, $values, $variables);

        $values = array_values($values);
        foreach ($variables as $key => $variable) {
            $value = $values[$key];
            if (is_string($value)) {
                $value = "'{$value}'";
            }

            $description = str_replace($variable, $value, $description);
        }

        $this->statements[$type][] = $description;
    }

    /**
     * @param string $type
     * @param array $values
     * @param array $variables
     *
     * @throws Exception\ScenarioException
     */
    private function guardAgainstMissingParameters($type, array $values, array $variables)
    {
        if (count($values) !== count($variables)) {
            throw ScenarioException::invalidVariableCountInStatement($type, $variables);
        }
    }
}
