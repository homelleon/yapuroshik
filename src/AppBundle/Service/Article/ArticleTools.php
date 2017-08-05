<?php

namespace AppBundle\Service\Article;

use AppBundle\Service\Article\Calculator\ArticleCalculator;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleTools {
    private $calculator;
    
    public function __construct(Registry $doctrine) {
        $this->calculator = new ArticleCalculator($doctrine);
    }

    /**
     * Gets article calculator object.
     * 
     * @return ArticleCalculator
     */
    public function getCalculator(): ArticleCalculator {
        return $this->calculator;
    }
}
