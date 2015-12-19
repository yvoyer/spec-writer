<?php
/**
 * This file is part of the spec-writer project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\SpecWriter;

/**
 * Class SpecWriterTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\SpecWriter
 */
final class SpecWriterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_should_build_a_feature_header()
    {
        $feature = SpecWriter::feature('Write a feature')
            ->asUser('Domain expert')
            ->inOrderTo('To read my specs')
            ->iNeedTo('Have readable specs');

        $this->assertInstanceOf(ScenarioBuilder::class, $feature);

        $expected = <<<EXPECTS
Feature: Write a feature
  As a Domain expert
  In order To read my specs
  I need to Have readable specs


EXPECTS;
        $this->assertSame($expected, (string) $feature);

        return $feature;
    }

    /**
     * @param ScenarioBuilder $builder
     *
     * @depends test_it_should_build_a_feature_header
     */
    public function test_it_should_build_a_scenario(ScenarioBuilder $builder)
    {
        $feature = $builder->scenario('Scenario #1')
            ->Given('I have a statement')
            ->Given('I have :count :string statement', 2, 'given')
            ->When('I do something')
            ->When('I :count things with :string', 2, 'value')
            ->Then('I should have a then statement')
            ->Then('I should have :count :string statement', 2, 'and')
        ->endScenario();

        $expected = <<<STRING
  Scenario: Scenario #1
    Given I have a statement
    And I have 2 'given' statement
    When I do something
    And I 2 things with 'value'
    Then I should have a then statement
    And I should have 2 'and' statement

STRING;
        $this->assertInstanceOf(ScenarioBuilder::class, $feature);
        $this->assertContains($expected, (string) $feature);
    }

    public function test_it_should_write_file_with_all_feature()
    {
        $feature = SpecWriter::feature('Feature name')
            ->asUser('Developer')
            ->inOrderTo('Do stuff')
            ->iNeedTo('Use feature')

        ->scenario('Do not have money')
            ->Given('I have :amount', '5$')
            ->Given('Product with name :name costs :amount', 'name', '10$')
            ->When('I buy product :name', 'name')
            ->When('I give :amount to pay', '5$')
            ->Then('I should have :amount', '0$')
            ->Then('I should have 1 product with name :name', 'name')
        ->endScenario()

        ->scenario('Pay with enough money')
            ->Given('I have :amount', '5$')
            ->Given('Product with name :name costs :amount', 'name', '10$')
            ->When('I buy product :name', 'name')
            ->When('I give :amount to pay', '5$')
            ->Then('I should have :amount', '0$')
            ->Then('I should have 1 product with name :name', 'name')
        ->endScenario();

        $file = __DIR__ . '/actual.feature';
        $feature->write($file);
        $this->assertFileEquals($file, __DIR__ . '/expected.feature');
    }

    public function tearDown()
    {
        @unlink(__DIR__ . '/actual.feature');
    }
}
