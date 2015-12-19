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

