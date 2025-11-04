<?php 

class ArticleController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle() : void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);
        
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }
        
        if (!isset($_SESSION['user'])) {

            $_SESSION['viewed_articles'] ??= [];
            $ttl = 5;
            $now = time();
            $already = isset($_SESSION['viewed_articles'][$id]) && ($now - $_SESSION['viewed_articles'][$id]) < $ttl;

            if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET' && !$already) {
                $articleManager->incrementViews($id);
                $_SESSION['viewed_articles'][$id] = $now;

                // Met à jour localement pour affichage instantané
                if (method_exists($article,'getViews') && method_exists($article,'setViews')) {
                    $article->setViews($article->getViews() + 1);
                }
            }
        }

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByArticleId($id);

        $view = new View($article->getTitle());
        $view->render("detailArticle", ['article' => $article, 'comments' => $comments]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }
}