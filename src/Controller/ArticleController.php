<?php
    namespace App\Controller;

    use App\Entity\Article;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    // Can specify routes above methods instead of in routes.yaml
    use Symfony\Component\Routing\Annotation\Route;
    // Restrict certain methods
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; 
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class ArticleController extends AbstractController {
        /**
         * @Route("/", name="article_list")
         * @Method({"GET"})
         */
        public function index() {
            //return new Response('<html><body>Hello</body></html>');
            //$articles = ['Article 1', 'Article 2'];
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();


            return $this->render('articles/index.html.twig', array('articles' => $articles));
        }

        /**
         * @Route("/article/new", name="new_article")
         * Method({"GET", "POST"})
         */
        public function new(Request $request) {
            $article = new Article();

            $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, array('attr' => 
                array('class' => 'form-control')))
                ->add('body', TextareaType::class, array(
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Create',
                    'attr' => array('class' => 'btn btn-primary mt3')
                ))
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('articles/new.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/article/edit/{id}", name="edit_article")
         * Method({"GET", "POST"})
         */
        public function editArticle(Request $request, $id) {
            $article = new Article();
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, array('attr' => 
                array('class' => 'form-control')))
                ->add('body', TextareaType::class, array(
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Update',
                    'attr' => array('class' => 'btn btn-primary mt3')
                ))
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                // Don't need persist because we're not saving a new article
                $entityManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('articles/edit.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/article/{id}", name="article_show")
         */
        public function show($id) {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            return $this->render('articles/show.html.twig', array('article' => $article));
        }

        /**
         * @Route("article/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id) {
            // Use doctrine to find article
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);


            
            $entityManager = $this->getDoctrine()->getManager(); // Start doctrine
            $entityManager->remove($article);
            $entityManager->flush(); // Flush (end) it

            // Fetch expects a response
            $response = new Response();
            $response->send();
        }

        // /**
        //  * @Route("/article/save")
        //  */
        // public function save() {
        //     $entityManager = $this->getDoctrine()->getManager();

        //     $article = new Article();
        //     $article->setTitle('Article Two');
        //     $article->setBody('This is the body for article two');

        //     $entityManager->persist($article);

        //     $entityManager->flush();

        //     return new Response('Saves an article with the id of ' .$article->getId());
        // }
    }