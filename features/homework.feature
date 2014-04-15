Feature: Homework from wikia

@javascript
  Scenario: Scenario 1 - Login
    When I am on "http://testhomework.wikia.com/"
    Then I should be on "http://testhomework.wikia.com/wiki/Test-homework_Wiki"
    When I mouse over ".ajaxLogin"
    Then I should see an "#UserLoginDropdown" element
    When I fill in "username" with "Krzysztof.zarychta"
      And I fill in "password" with "test123"
      And I click "input.login-button"
    Then I should see "Krzysztof.zarychta" in the "#AccountNavigation>li>a" element

@javascript
  Scenario: Scenario 2 - add video
    Given I have been logged as user name "Krzysztof.zarychta" and password "test123"
    When I am on "http://testhomework.wikia.com/"
    Then I should be on "http://testhomework.wikia.com/wiki/Test-homework_Wiki"
    When I click ".wikia-menu-button.contribute.secondary.combined"
    Then I should see an ".WikiaMenuElement>li>a" element
    When I follow "Add a Video"
    Then I should be on "http://testhomework.wikia.com/wiki/Special:WikiaVideoAdd"
    When I fill in "wpWikiaVideoAddUrl" with "http://www.youtube.com/watch?v=h9tRIZyTXTI"
      And I click ".submits>input"
    Then I should see "Video page" in the ".msg" element
      And I should see "was successfully added." in the ".msg" element
    When I remember text "filename" from ".msg>a" element
      And I click ".msg>a"
    Then I should be on "http://testhomework.wikia.com/wiki/" with text "filename"
      And I should see text "filename"

