<?php

use Codeception\Example;

class UserCest {

    public function _before(AcceptanceTester $I) {
        $I->am('User');
    }

    public function _after(AcceptanceTester $I) {
        
    }

    // tests
    /**
     * @dataprovider pageDataProvider
     * @param AcceptanceTester I
     */
    public function smokeTest(AcceptanceTester $I, Example $page) {
        $I->amOnPage($page['url']);
        $I->see($page['content']);
    }
    
    /**
     * 
     * @return array
     */
    protected function pageDataProvider() {
        return [
            'main_page' => ['url'=> '/', 
                'content' => 'Рад вас приветствовать на моем сайте!'],
            'about_page' => ['url'=> '/about', 
                'content' => 'Здравствуйте, меня зовут Сергей "Япрошик"!'],
            'photo_page' => ['url'=> '/photo', 
                'content' => 'вход'],
            'video_page' => ['url'=> '/video', 
                'content' => 'вход'],
            'contacts_page' => ['url'=> '/contacts', 
                'content' => 'Контактные данные'],
            'login_page' => ['url'=> '/login', 
                'content' => 'Введите логин и пароль для входа!'],
            'registration_page' => ['url'=> '/registration', 
                'content' => 'Введите ваши данные для регистрации на сайте!'],
            'admin_page' => ['url'=> '/admin', 
                'content' => 'Введите логин и пароль для входа!']
        ];
    }
}
