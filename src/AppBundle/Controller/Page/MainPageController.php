<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User\User;

class MainPageController extends Controller {

    const ARTICLES_PER_PAGE = 5;

    /**
     * @Route("/", name="main")
     * @Method("GET")
     */
    public function mainAction() {
        return $this->pageAction(1);
    }

    /**
     * @Route("/page/{page}", name="show_page")
     */
    public function pageAction($page) {
        if ($page <= 0) {
            throw $this->createNotFoundException(
                    'Incorrect page number: ' . $page
            );
        }
        $articleCalculator = $this->get('article_calculator');
        $pageCount = $articleCalculator->calculatePageCount();
        $pages = array();
        if ($pageCount != 1) {
            for ($i = 1; $i <= $pageCount; $i++) {
                $pages[] = $i;
            }
        } else {
            $pages[] = 1;
        }
        if ($page > count($pages) && $page > 1) {
            throw $this->createNotFoundException(
                    'There is no page number: ' . $page
            );
        }
        $articles = $articleCalculator->getByPage($page);
        return $this->render(':Blog/Page:index.html.twig', [
                    'articles' => $articles,
                    'pages' => $pages
        ]);
    }

    /**
     * Renders page of sorted articles depending on category and value
     * parameters.
     * 
     * @Route("/sort/news/{category}/{value}/{page}", name="news_sorted")
     * @param string $category
     * @param string $value
     */
    public function sortAction($category, $value, $page) {
        $dorctrine = $this->getDoctrine();
        $articleCalculator = $this->get('article_calculator');        

        if ($category == 'author') {
            $user = $dorctrine->getRepository(User::class)
                    ->findOneBy([
                'username' => $value
            ]);
            $newValue = $user;
        } else {
            $newValue = $value;
        }
        
        $pages = array();        
        $pageCount = $articleCalculator->calculateSortedPageCount($category, $newValue);
        if ($pageCount != 1) {
            for ($i = 1; $i <= $pageCount; $i++) {
                $pages[] = $i;
            }
            
        } else {
            $pages[] = 1;
        }
        if ($page > count($pages) && $page > 1) {
            throw $this->createNotFoundException(
                    'There is no page number: ' . $page
            );
        }
        $articles = $articleCalculator->getSortedByPage($page, $category, $newValue);        
        $categoryRus = $articleCalculator->getSortCategoryRus($category);
        return $this->render(':Blog/News:news_sorted.html.twig', [
                    'articles' => $articles,
                    'pages' => $pages,
                    'category' => $category,
                    'categoryRus' => $categoryRus,
                    'value' => $value
        ]);
    }

}
