<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    // Can specify routes above methods instead of in routes.yaml
    use Symfony\Component\Routing\Annotation\Route;
    // Restrict certain methods
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; 
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class ArticleController extends AbstractController {
        /**
         * @Route("/")
         * @Method({"GET"})
         */
        public function index() {
            //return new Response('<html><body>Hello</body></html>');
            return $this->render('articles/index.html.twig');
        }
    }