<?php

class AnonymUserCest {

    public function _before(AcceptanceTester $I) {
        
    }

    public function _after(AcceptanceTester $I) {
        
    }

    // tests
    public function seeAllPagesTest(AcceptanceTester $I) {
        $I->am('anonym');
        $I->wantTo('see all pages');
        $I->amOnPage('/');
        $I->see('япрошик');
        $I->see('вход');
        $I->see('регистрация');
        $I->see('рад вас приветствовать на моем сайте!');
        $I->click('Обо мне');
        $I->see('здравствуйте, меня зовут Сергей "Япрошик"!');
        $I->click('Фото');
        $I->click('Видео');
        $I->click('Контакты');
        $I->see('контактные данные');
        $I->click('вход');
        $I->see('Введите логин и пароль для входа!');
        $I->see('Username');
        $I->see('Password');
    }
    
    public function seePagesNoAccessTest(AcceptanceTester $I) {
        $I->am('anonym');
        $I->wantTo('see pages with no access');
        $I->amOnPage('/');
        $I->amOnPage('/admin');
        $I->see('Введите логин и пароль для входа!');
    }
    
    public function seeWrongPages(AcceptanceTester $I) {
        $I->am('anonym');
        $I->wantTo('see wrong pages');
        $I->amOnPage('/page/3');
        $I->see('404');
    }
}
