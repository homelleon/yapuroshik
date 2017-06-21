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

    public function calculatePageCount() {
        $articles = $this->doctrine
        ->getRepository(Article::class)
                ->findBy(
                array(), array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pageCount = (int) (($articleCount - 1) / self::ARTICLES_PER_PAGE + 1);

        return $pageCount;
    }
    
    public function getArticlesByPage($page) {
        $offset = $page * self::ARTICLES_PER_PAGE - self::ARTICLES_PER_PAGE;
        $articles = $this->doctrine->getRepository(Article::class)
                ->findBy(
                array(), array('created' => 'DESC'), self::ARTICLES_PER_PAGE, $offset
        );
        return $articles;
    }

}
