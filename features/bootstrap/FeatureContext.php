<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\Behat\Context\Step\When;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext //BehatContext
{
    public static $text;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I wait (\d+)$/
     */
    public function iWate($i)
    {
        sleep($i);
    }

    /**
     * @Given /^I mouse over "([^"]*)"$/
     */
    public function iMouseOver($locator)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', $locator);

        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
        }

        $element->mouseOver();
	sleep(1);
    }

    /**
     * @Given /^I click "([^"]*)"$/
     */
    public function iClick($locator)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', $locator);

        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
        }

        $element->click();
    }

    /**
     * @Given /^I remember text "([^"]*)" from "([^"]*)" element$/
     */
    public function iRememberText($textName, $locator)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', $locator);

        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
        }

        
        $this->text[$textName] = $element->getText();
    }

    /**
     * @Given /^I should see text "([^"]*)"$/
     */
    public function iShouldSeeText($textName)
    {
        $step = array( new When('I should see "'.$this->text[$textName].'"'));
    }

    /**
     * @Given /^I should be on "([^"]*)" with text "([^"]*)"$/
     */
    public function iShouldBeOnWithText($url, $textName)
    {
        $step = array( new When('I should be on "'.$url.str_replace(" ", "_", $this->text[$textName].'"')));

	return $step;
    }

   /**
     * @Given /^I have been logged as user name "([^"]*)" and password "([^"]*)"$/
     */
    public function iHaveBeenLoggedAsUserNameAndPassword($userName, $password)
    {
    	$step = array(
		new When('I am on "http://testhomework.wikia.com/"'),
		new When('I mouse over ".ajaxLogin"'),
		new When('I fill in "username" with "'.$userName.'"'),
      		new When('I fill in "password" with "'.$password.'"'),
      		new When('I click "input.login-button"')
		);
        return $step;       
    }

}
