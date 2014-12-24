<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

use Star\SpecWriter\Dumper\Dumper;
use Star\SpecWriter\Dumper\FeatureDumper;
use Star\SpecWriter\Keyword\Feature;
use Star\SpecWriter\Keyword\Goal;
use Star\SpecWriter\Keyword\Scenario;

/**
 * Class SpecWriterTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter
 */
final class SpecWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SpecWriter
     */
    private $writer;

    /**
     * @var Dumper
     */
    private $dumper;

    public function setUp()
    {
        $this->writer = new SpecWriter();
        $this->dumper = new FeatureDumper();
    }

    public function test_should_write_feature()
    {
        $this->writer->startFeature('My first feature');
        $feature = $this->assertFeatureIsReturned();
        $this->assertSame('My first feature', $feature->title());
    }

    public function test_could_have_a_goal()
    {
        $this->writer->inOrderTo('Write a goal', 'Spec writer', 'Add a long description');

        $feature = $this->assertFeatureIsReturned();
        $goal = $feature->goal();
        $this->assertInstanceOf(Goal::CLASS_NAME, $goal);
        $this->assertSame('Write a goal', $goal->inOrder());
        $this->assertSame('Spec writer', $goal->asUser());
        $this->assertSame('Add a long description', $goal->description());
    }

    public function test_could_define_scenarios()
    {
        $this->writer->startScenario('Write a valid scenario');
        $this->writer->addGiven('The first given');
        $this->writer->addGiven('The second given');
        $this->writer->addWhen('The first when');
        $this->writer->addWhen('The second when');
        $this->writer->addThen('The first then');
        $this->writer->addThen('The second then');
        $scenario = $this->writer->endScenario();

        $this->assertInstanceOf(Scenario::CLASS_NAME, $scenario);

        $this->assertSame('Write a valid scenario', $scenario->title());
        $this->assertCount(2, $scenario->givens());
        $this->assertSame('The first given', $scenario->givens()[0]->statement());
        $this->assertSame('The second given', $scenario->givens()[1]->statement());

        $this->assertCount(2, $scenario->whens());
        $this->assertSame('The first when', $scenario->whens()[0]->statement());
        $this->assertSame('The second when', $scenario->whens()[1]->statement());

        $this->assertCount(2, $scenario->thens());
        $this->assertSame('The first then', $scenario->thens()[0]->statement());
        $this->assertSame('The second then', $scenario->thens()[1]->statement());
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The current scenario is not initialised.
     */
    public function test_end_scenario_should_throw_exception_when_current_scenario_not_defined()
    {
        $this->writer->endScenario();
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The current scenario is not initialised.
     */
    public function test_add_given_should_throw_exception_when_current_scenario_not_defined()
    {
        $this->writer->addGiven('');
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The current scenario is not initialised.
     */
    public function test_add_when_should_throw_exception_when_current_scenario_not_defined()
    {
        $this->writer->addWhen('');
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The current scenario is not initialised.
     */
    public function test_add_then_should_throw_exception_when_current_scenario_not_defined()
    {
        $this->writer->addThen('');
    }

    /**
     * @return Feature
     */
    private function assertFeatureIsReturned()
    {
        $feature = $this->writer->endFeature();
        $this->assertInstanceOf(Feature::CLASS_NAME, $feature);

        return $feature;
    }

    public function test_should_dump_the_feature()
    {
        $this->writer->startFeature('Dump feature');
        $this->writer->inOrderTo('Read my spec', 'Domain expert', 'Have readable specs');

        $this->writer->startScenario('Scenario 1');
        $this->writer->addGiven('I have my first given');
        $this->writer->addGiven('I have my second given');
        $this->writer->addWhen('I have my first when');
        $this->writer->addWhen('I have my second when');
        $this->writer->addThen('I have my first then');
        $this->writer->addThen('I have my second then');
        $this->writer->endScenario();

        $this->writer->startScenario('Scenario 2');
        $this->writer->addGiven('I have my third given');
        $this->writer->addGiven('I have my fourth given');
        $this->writer->addWhen('I have my third when');
        $this->writer->addWhen('I have my fourth when');
        $this->writer->addThen('I have my third then');
        $this->writer->addThen('I have my fourth then');
        $this->writer->endScenario();

        $feature = $this->writer->endFeature();

        $expected = <<<EXPECTED
Feature: Dump feature
  In order to Read my spec
  As a Domain Expert
  I should Have readable specs

  Scenario: Scenario 1
    Given I have my first given
    And I have my second given
    When I have my first when
    And I have my second when
    Then I have my first then
    And I have my second then

  Scenario: Scenario 2
    Given I have my third given
    And I have my fourth given
    When I have my third when
    And I have my fourth when
    Then I have my third then
    And I have my fourth then

EXPECTED;
        $this->assertSame($expected, $this->dumper->dump($feature));
    }
}
