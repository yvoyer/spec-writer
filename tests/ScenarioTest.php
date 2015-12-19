<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class ScenarioTest
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class ScenarioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Scenario
     */
    private $scenario;

    public function setUp()
    {
        $this->scenario = new Scenario('Scenario name');
    }

    /**
     * @param array $expected
     * @param $string
     *
     * @dataProvider provideDataToExtract
     */
    public function test_it_should_extract_the_variables(array $expected, $string)
    {
        $this->assertSame($expected, $this->scenario->extractVariables($string));
    }

    public static function provideDataToExtract()
    {
        return [
            'Should find single var' => [[':var1'], ':var1'],
            'Should find multiple vars' => [[':var1', ':var2'], ':var1 :var2'],
            'Should find vars when string before' => [[':var1', ':var2'], 'before :var1 :var2'],
            'Should find vars when string between' => [[':var1', ':var2'], ':var1 between :var2'],
            'Should find vars when string after' => [[':var1', ':var2'], ':var1 :var2 after'],
            'Should find vars when : char present but not var' => [[':var1'], 'String with :var1 and other: string'],
        ];
    }

    /**
     * @expectedException        \Star\SpecWriter\Exception\ScenarioException
     * @expectedExceptionMessage The variables '[:var1]' were not initialized before adding another 'Given'.
     */
    public function test_it_should_throw_exception_when_adding_given_statement_with_uninitialized_previous_variables()
    {
        $this->scenario->andGiven(':var1');
    }

    /**
     * @expectedException        \Star\SpecWriter\Exception\ScenarioException
     * @expectedExceptionMessage The variables '[:var1]' were not initialized before adding another 'When'.
     */
    public function test_it_should_throw_exception_when_adding_when_statement_with_uninitialized_previous_variables()
    {
        $this->scenario->andWhen(':var1');
    }

    /**
     * @expectedException        \Star\SpecWriter\Exception\ScenarioException
     * @expectedExceptionMessage The variables '[:var1]' were not initialized before adding another 'Then'.
     */
    public function test_it_should_throw_exception_when_adding_then_statement_with_uninitialized_previous_variables()
    {
        $this->scenario->andThen(':var1');
    }

    public function test_it_should_set_the_parameters_of_given_statement() {
        $this->scenario->andGiven('String with :string and :int and :float', ['string value', 2, 2.2]);

        $this->assertContains("    Given String with 'string value' and 2 and 2.2", (string) $this->scenario);
    }

    public function test_it_should_set_the_parameters_of_when_statement() {
        $this->scenario->andWhen('String with :string and :int and :float', ['string value', '3', '4.5']);

        $this->assertContains("    When String with 'string value' and '3' and '4.5'", (string) $this->scenario);
    }

    public function test_it_should_set_the_parameters_of_then_statement() {
        $this->scenario->andThen('String with :string and :int and :float', ['string value', 8, '3.5']);

        $this->assertContains("    Then String with 'string value' and 8 and '3.5'", (string) $this->scenario);
    }

    public function test_it_should_write_scenario()
    {
        $expected = <<<SCEANRIO
  Scenario: Scenario name
    Given Given 1
    And Given 2
    When When 1
    And When 2
    Then Then 1
    And Then 2


SCEANRIO;
        $this->scenario->andGiven('Given 1');
        $this->scenario->andGiven('Given 2');
        $this->scenario->andWhen('When 1');
        $this->scenario->andWhen('When 2');
        $this->scenario->andThen('Then 1');
        $this->scenario->andThen('Then 2');

        $this->assertContains($expected, (string) $this->scenario);
    }
}
