Yapuroshik
==========

[![Code Climate](https://codeclimate.com/github/homelleon/yapuroshik/badges/gpa.svg)](https://codeclimate.com/github/homelleon/yapuroshik)
[![Test Coverage](https://codeclimate.com/github/homelleon/yapuroshik/badges/coverage.svg)](https://codeclimate.com/github/homelleon/yapuroshik/coverage)
[![Issue Count](https://codeclimate.com/github/homelleon/yapuroshik/badges/issue_count.svg)](https://codeclimate.com/github/homelleon/yapuroshik)
[![Build Status](https://travis-ci.org/homelleon/yapuroshik.svg?branch=master)](https://travis-ci.org/homelleon/yapuroshik)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/homelleon/yapuroshik/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/homelleon/yapuroshik/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/homelleon/yapuroshik/badges/build.png?b=master)](https://scrutinizer-ci.com/g/homelleon/yapuroshik/build-status/master)

This is a project to create web-page using article-base system with ability to add comments and images and user authorisation. 
I make this project for studying php language and Symfony framework, but also I'm going to use it in production as my personal traveling blog.

AppBundle
-------

#### Controllers:
1. Admin 
    - PageAdminController
    - RoleAdminController
    - UserAdminController        
2. Article 
    - ArticleController
3. Comment
    - CommentController
4. File
    - ImageController
5. Page
    - ContactsRedirectController
    - MainPageController
    - PageController
6. Security
    - SecurityController
7. User 
    - UserController

#### Entities:
1. Blog
     - Article
     - Comment       
2. File
     - Avatar
     - Image
     - ImageBase       
3. User 
    - Role
    - User
    - UserAccount
    
#### Form
1. Blog
    - Article
        - ArticleType
        - EditArticleType
    - Comment
        - CommentType
2. Param
    - GenderType
    - RoleParamType
3. Role
    - RoleCreateType
4. User
    - UserAccountType
    - UserType

#### Services:
1. FileConfigurator
