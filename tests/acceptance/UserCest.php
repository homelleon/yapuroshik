<?php

class UserCest {
    
    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/');
    }

    public function _after(AcceptanceTester $I) {
        
    }

    // tests
    public function wrongLoginTest(AcceptanceTester $I) {
        $I->am('not registred user');
        $I->wantTo('try to login as user with wrong parameters');
        $I->click('вход');
        $I->fillField('_username', 'wrongUser');
        $I->fillField('_password', 'wrongPassword');
        $I->click('подтвердить');
        $I->see('Invalid credentials');
    }

    public function loginTest(AcceptanceTester $I) {
        $I->am('registered user');
        $I->wantTo('login as user');
        $I->click('вход');
        $I->fillField('_username', 'admin');
        $I->fillField('_password', 'href');
        $I->click('подтвердить');
        $I->see('выход');
        $I->click('выход');
    }
    
    public function registerTest(AcceptanceTester $I) {
        $I->am('not registered user');
        $I->wantTo('register as new user');
        $I->click('регистрация');
        $I->see('Введите ваши данные для регистрации на сайте!');
        
    }

}
