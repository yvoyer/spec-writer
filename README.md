spec-writer
===========
[![Build Status](https://travis-ci.org/yvoyer/spec-writer.svg)](https://travis-ci.org/yvoyer/spec-writer)

Gherkin style specification writer

Usage in php

```php
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

    // Write the feature to the feature file so that it can be executed by the test suite.
    $file = __DIR__ . '/actual.feature';
    $feature->write($file);
```

The use case would generate the following file content:


```php
    // Content of "actual.feature" file
    Feature: Feature name
      As a Developer
      In order Do stuff
      I need to Use feature

      Scenario: Do not have money
        Given I have '5$'
        And Product with name 'name' costs '10$'
        When I buy product 'name'
        And I give '5$' to pay
        Then I should have '0$'
        And I should have 1 product with name 'name'

      Scenario: Pay with enough money
        Given I have '5$'
        And Product with name 'name' costs '10$'
        When I buy product 'name'
        And I give '5$' to pay
        Then I should have '0$'
        And I should have 1 product with name 'name'
```
