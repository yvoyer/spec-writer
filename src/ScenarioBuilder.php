<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class ScenarioBuilder
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class ScenarioBuilder implements GivenBuilder, WhenBuilder, ThenBuilder, Writer
{
    /**
     * @var Feature
     */
    private $feature;

    /**
     * @var Scenario[]
     */
    private $scenarios = [];

    /**
     * @var Scenario
     */
    private $current;

    /**
     * @param Feature $feature
     */
    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param string $description
     *
     * @return ScenarioBuilder
     */
    public function scenario($description)
    {
        $this->current = new Scenario($description);

        return $this;
    }

    /**
     * @param $description
     * @param null $variables todo Replace by variadic argument
     *
     * @return GivenBuilder
     */
    public function Given($description, $variables = null)
    {
        $variables = func_get_args();
        array_shift($variables);
        $this->current->andGiven($description, $variables);

        return $this;
    }

    /**
     * @param $description
     * @param null $variables todo Replace by variadic argument
     *
     * @return WhenBuilder
     */
    public function When($description, $variables = null)
    {
        $variables = func_get_args();
        array_shift($variables);
        $this->current->andWhen($description, $variables);

        return $this;
    }

    /**
     * @param $description
     * @param null $variables todo Replace by variadic argument
     *
     * @return ThenBuilder
     */
    public function Then($description, $variables = null)
    {
        $variables = func_get_args();
        array_shift($variables);
        $this->current->andThen($description, $variables);

        return $this;
    }

    /**
     * @return ScenarioBuilder
     */
    public function endScenario()
    {
        $this->scenarios[] = $this->current;
        $this->current = null;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = (string) $this->feature;
        foreach($this->scenarios as $scenario) {
            $string .= (string) $scenario;
        }

        return $string;
    }

    /**
     * @param string $filepath
     */
    public function write($filepath)
    {
        file_put_contents($filepath, (string) $this);
    }
}
