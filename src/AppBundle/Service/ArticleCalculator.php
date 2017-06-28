<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use AppBundle\Entity\Blog\Article;

/**
 * Calculates variables for artciles.
 *
 * @author Админ
 */
class ArticleCalculator {
    
    const ARTICLES_PER_PAGE = 5;
    
    private $doctrine;

    public function __construct(Registry $doctrine) {
        $this->doctrine = $doctrine;
    }
    
    /**
     * Calculates how much pages articles takes.
     * 
     * @return type
     */
    public function calculatePageCount() {
        $pageCount = $this->calculateSortedPageCount(null, null);
        return $pageCount;
    }
    
    /**
     * Calculates how much pages sorted by category and its value 
     * articles takes.
     * 
     * @return type
     */
    public function calculateSortedPageCount($category, $value) {
        if($category == null || $value == null) {
            $sortedArray = array();
        } else {
            $sortedArray = array($category => $value);
        }
        $articles = $this->doctrine
        ->getRepository(Article::class)
                ->findBy(
                $sortedArray, array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pageCount = (int) (($articleCount - 1) / self::ARTICLES_PER_PAGE + 1);

        return $pageCount;
    }
    
    /**
     * Gets all articles from repository orderd from old to new.
     * 
     * @return type
     */
    public function getAll() {
        $articles = getAllSorted(null, null);
        return $articles;
    }
    
    /**
     * Gets all articles with chosen category and its value from repository 
     * orderd from old to new.
     * 
     * @param type $category
     * @param type $value
     * @return type
     */
    public function getAllSorted($category, $value) {
        if($category == null || $value == null) {
            $sortedArray = array();
        } else {
            $sortedArray = array($category => $value);
        }
        $articles = $this->doctrine
                ->getRepository(Article::class)
                ->findBy(
                $sortedArray,
                array('created' => 'DESC')
        );
        return $articles;
    }


    /**
     * Gets all articles from chosen page.
     * 
     * @param type $page
     * @return array of articles
     */
    public function getByPage($page) {
        $articles = $this->getSortedByPage($page, null, null);
        return $articles;
    }
    
    /**
     * Gets articles from chosen page, sorted by category and category value parameters.
     * 
     * @param type $page
     * @param type $category
     * @param type $value
     * @return array of articles
     */
    public function getSortedByPage($page, $category, $value) {
        if($category == null || $value == null) {
            $sortArray = array();
        } else {
            $sortArray = array($category => $value);
        };
        $offset = $page * self::ARTICLES_PER_PAGE - self::ARTICLES_PER_PAGE;
        $articles = $this->doctrine->getRepository(Article::class)
                ->findBy(
                    $sortArray, array('created' => 'DESC'), 
                    self::ARTICLES_PER_PAGE, $offset
        );
        return $articles;
    }
    
    /**
     * Gets russian word for category name.
     * 
     * @param type $category
     * @return string
     */
    public function getSortCategoryRus($category) {
        switch ($category) {
            case 'theme':
                $category = 'теме';
                break;
            case 'title':
                $category = 'названию';
                break;
            case 'author':
                $category = 'автору';
                break;
        }
        return $category;
    }

}
