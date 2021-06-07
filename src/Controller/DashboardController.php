<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Entity\Posts;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(PaginatorInterface $paginator , Request $request)
    {
        $user = $this->getUser();
        //OBTENGO AL USUARIO ACTUALMENTE LOGUEADO
        if($user)
        {
        $em =$this->getDoctrine()->getManager();
        $query=$em->getRepository(Posts::class)->Buscartodolosposts();
        $comentarios = $em->getRepository(Comentario::class)->BuscarComentarios($user->getId());
            // Consulto los comentarios con el ID del usuario actualmente logueado
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('dashboard/index.html.twig', [
            'pagination'=>$pagination,
            'comentario'=>$comentarios
        ]);
        }else
        {
            return $this->redirectToRoute('ap_login');
        }
    }
}
