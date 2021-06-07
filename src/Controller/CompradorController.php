<?php

namespace App\Controller;


use App\Entity\Comprador;
use App\Form\CompradorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompradorController extends AbstractController
{
    /**
     * @Route("/comprador", name="comprador")
     */
    public function index( Request $request)
    {
        $comprador = new Comprador();
        $form = $this->createForm(CompradorType::class, $comprador);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {

            $user=$this->getUser();
            $comprador->setUser($user);
            $em =$this->getDoctrine()->getManager();
            $em->persist($comprador);
            $em->flush();
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('comprador/index.html.twig', [
            'form'=> $form->createView()
        ]);
    }
      //  return $this->render('comprador/index.html.twig', [
        //    'controller_name' => 'CompradorController',
        //]);
    //}





}
