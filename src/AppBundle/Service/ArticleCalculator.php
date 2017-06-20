<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Blog\Article;

/**
 * Calculates variables for artciles.
 *
 * @author Админ
 */
class ArticleCalculator {

    private $doctrine;
    private $articlesPerPageCount;

    public function __construct(EntityManagerInterface $doctrine, int $articlesPerPageCount) {
        $this->entityManager = $entityManager;
        $this->articlesPerPageCount = $articlesPerPageCount;
    }

    public function calculatePageCount() {
        $articles = $this->entityManager
        ->getRepository(Article::class)
                ->findBy(
                array(), array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pageCount = (int) (($articleCount - 1) / $this->articlePerPageCount + 1);

        return $pageCount;
    }

}
