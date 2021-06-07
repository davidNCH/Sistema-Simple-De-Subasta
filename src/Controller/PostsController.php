<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Entity\Posts;
use App\Form\ComentarioType;
use App\Form\PostsType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostsController extends AbstractController
{
    /**
     * @Route("/registrar-posts", name="registrarpost")
     */
    public function index(Request $request, SluggerInterface $slugger)
    {
        $post = new  Posts();
            $form = $this->createForm(PostsType::class, $post);
            $form->handleRequest($request);
            if($form->isSubmitted()&&$form->isValid())
            {
                $brochureFile=$form['foto']->getData();
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename=$slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('photos_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        throw new \Exception('Ups, Ocurrio un error');
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $post->setFoto($newFilename);
                }
                $user=$this->getUser();
            $post->setUser($user);
            $em =$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('posts/index.html.twig', [
            'form'=> $form->createView()
        ]);
    }


    /**
     * @Route("/post/{id}", name="verPost")
     */

    public function VerPosts($id, Request $request , PaginatorInterface $paginator)
    {
        $em=$this->getDoctrine()->getManager();
        $comentario = new Comentario();
        $post=$em->getRepository(Posts::class)->find($id);
        $queryComentarios = $em->getRepository(Comentario::class)->BuscarComentariosDeUNPost($post->getId());
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $comentario->setPosts($post);
            $comentario->setUser($user);
            $em->persist($comentario);
            $em->flush();
            $this->addFlash('Exito', Comentario::COMENTARIO_AGREGADO_EXITOSAMENTE);
            return $this->redirectToRoute('verPost',['id'=>$post->getId()]);
        }
        $pagination = $paginator->paginate(
            $queryComentarios, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('posts/verPost.html.twig',['post'=>$post, 'form'=>$form->createView(), 'comentarios'=>$pagination]);
    }

    /**
     * @Route("/Mis-posts", name="misPosts")
     */

    public  function  misPost()
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $posts=$em->getRepository(Posts::class)->findBy(['user'=>$user]);
        return $this->render('posts/misposts.html.twig',['posts'=>$posts]);
    }

    /**
     * @Route("/Likes", options={"expose"=true}, name="Likes")
     */
    public function Like(Request $request){
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');
            $post = $em->getRepository(Posts::class)->find($id);
            $likes = $post->getLikes();
            $likes .= $user->getId().',';
            $post->setLikes($likes);
            $em->flush();
            return new JsonResponse(['likes'=>$likes]);
        }else{
            throw new \Exception('Estás tratando de hackearme?');
        }
    }


}
