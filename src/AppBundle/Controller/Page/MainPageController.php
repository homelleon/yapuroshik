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
     * @param int $page
     */
    public function pageAction(int $page) {
        if ($page <= 0) {
            throw $this->createNotFoundException(
                    'Incorrect page number: ' . $page
            );
        }
        $articleCalculator = $this->get('article_tools')->getCalculator();
        $pageCount = $articleCalculator->calculatePageCount();
        
        if ($page > $pageCount && $page > 1) {
            throw $this->createNotFoundException(
                    'There is no page number: ' . $page
            );
        }
        $articles = $articleCalculator->getByPage($page);
        return $this->render(':Blog/Page:index.html.twig', [
                    'articles' => $articles,
                    'pageCount' => $pageCount
        ]);
    }

    /**
     * Renders page of sorted articles depending on category and value
     * parameters.
     * 
     * @Route("/sort/news/{category}/{value}/{page}", name="news_sorted")
     * @param string $category
     * @param string $value
     * @param int $page
     */
    public function sortAction($category, $value, int $page) {
        $dorctrine = $this->getDoctrine();
        $articleCalculator = $this->get('article_tools')->getCalculator();        

        if ($category == 'author') {
            $user = $dorctrine->getRepository(User::class)
                    ->findOneBy([
                'username' => $value
            ]);
            $newValue = $user;
        } else {
            $newValue = $value;
        }
          
        $pageCount = $articleCalculator->calculateSortedPageCount($category, $newValue);
        if ($page > $pageCount && $page > 1) {
            throw $this->createNotFoundException(
                    'There is no page number: ' . $page
            );
        }
        $articles = $articleCalculator->getSortedByPage($page, $category, $newValue); 
        $categoryRus = $articleCalculator->getSortCategoryRus($category);
        return $this->render(':Blog/News:news_sorted.html.twig', [
                    'articles' => $articles,
                    'pageCount' => $pageCount,
                    'category' => $category,
                    'categoryRus' => $categoryRus,
                    'value' => $value
        ]);
    }

}
