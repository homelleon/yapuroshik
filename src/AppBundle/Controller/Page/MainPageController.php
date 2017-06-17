<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Blog\Article;
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
        $doctrine = $this->getDoctrine();
        $articlePerPageCount = self::ARTICLES_PER_PAGE;
        $articles = $doctrine->getRepository(Article::class)
                ->findBy(
                array(), array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pageCount = (int) (($articleCount - 1) / $articlePerPageCount + 1);
        $pages = array();
        if ($pageCount != 1) {
            for ($i = 1; $i <= $pageCount; $i++) {
                $pages[] = $i;
            }
            $offset = $page * $articlePerPageCount - $articlePerPageCount;
            $articles = $doctrine->getRepository(Article::class)
                    ->findBy(
                    array(), array('created' => 'DESC'), $articlePerPageCount, $offset
            );
        } else {
            $pages[] = 1;
        }

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
        $articlePerPageCount = self::ARTICLES_PER_PAGE;

        if ($category == 'author') {
            $user = $dorctrine->getRepository(User::class)
                    ->findOneBy([
                'username' => $value
            ]);
            $newValue = $user;
        } else {
            $newValue = $value;
        }

        $articles = $dorctrine->getRepository(Article::class)
                ->findBy(
                array($category => $newValue), array('created' => 'DESC')
        );
        $articleCount = count($articles);
        $pages = array();
        $pageCount = (int) (($articleCount - 1) / $articlePerPageCount + 1);
        if ($pageCount != 1) {
            for ($i = 1; $i <= $pageCount; $i++) {
                $pages[] = $i;
            }
            $offset = $page * $articlePerPageCount - $articlePerPageCount;

            $articles = $dorctrine->getRepository(Article::class)
                    ->findBy(
                    array($category => $newValue), array('created' => 'DESC'), $articlePerPageCount, $offset
            );
        } else {
            $pages[] = 1;
        }
        $categoryRus = $this->getSortCategoryRus($category);
        return $this->render(':Blog/News:news_sorted.html.twig', [
                    'articles' => $articles,
                    'pages' => $pages,
                    'category' => $category,
                    'categoryRus' => $categoryRus,
                    'value' => $value
        ]);
    }

    private function getSortCategoryRus($category) {
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
