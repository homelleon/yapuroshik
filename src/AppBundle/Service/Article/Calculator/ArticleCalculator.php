<?php

namespace AppBundle\Service\Article\Calculator;

use Doctrine\Bundle\DoctrineBundle\Registry;
use AppBundle\Entity\Blog\Article;
use AppBundle\Entity\User\User;

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
     * Calculates how many pages articles take.
     * 
     * @return integer page count value
     */
    public function calculatePageCount(): int {
        $pageCount = $this->calculateSortedPageCount(null, null);
        return $pageCount;
    }
    
    /**
     * Calculates how many pages sorted articles take.
     * 
     * @param string|null $category
     * @param string|User|null $value
     * @return integer page count value
     */
    public function calculateSortedPageCount($category, $value): int {
        if($category === null || $value === null) {
            $sortedArray = array('isDeleted' => 0);
        } else {
            $sortedArray = array('isDeleted' => 0, $category => $value);
        }
        $articles = $this->doctrine
        ->getRepository(Article::class)
                ->findBy(
                $sortedArray,
                array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pageCount = (integer) (($articleCount - 1) / self::ARTICLES_PER_PAGE + 1);

        return $pageCount;
    }
    
    /**
     * Gets all articles from repository orderd from old to new.
     * 
     * @return array of articles
     */
    public function getAll(): array {
        $articles = getAllSorted(null, null);
        return $articles;
    }
    
    /**
     * Gets all articles with chosen category and its value from repository 
     * orderd from old to new.
     * 
     * @param string|null $category
     * @param string|User|null $value
     * @return array of articles
     */
    public function getAllSorted($category, $value): array {
        if($category === null || $value === null) {
            $sortedArray = array('isDeleted' => 0);
        } else {
            $sortedArray = array('isDeleted' => 0, $category => $value);
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
     * @param int $page
     * @return array of articles
     */
    public function getByPage(int $page): array {
        $articles = $this->getSortedByPage($page, null, null);
        return $articles;
    }
    
    /**
     * Gets articles from chosen page, sorted by category and category value parameters.
     * 
     * @param int $page
     * @param string|null $category
     * @param string|User|null $value
     * @return array of articles
     */
    public function getSortedByPage(int $page, $category, $value): array {
        if($category === null || $value === null) {
            $sortArray = array('isDeleted' => 0);
        } else {
            $sortArray = array('isDeleted' => 0, $category => $value);
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
     * @param string|null $category
     * @return string value of russian text
     */
    public function getSortCategoryRus($category): string {
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
