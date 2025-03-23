<?php

namespace App\Controller;

use App\Entity\Proveidor;
use App\Repository\ProveidorRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveidorController extends AbstractController
{
    /**
     * @Route("/", name="app_index_proveidor")
     */

    public function index(ProveidorRepository $proveidorRepository): Response
    {
        $proveidors = $proveidorRepository->findAll();
        return $this->render('proveidor/index.html.twig', [
            'proveidors' => $proveidors,
        ]);
    }

    /**
     * @Route("/afegir", name="app_afegir_proveidor")
     */
    public function create(): Response
    {
        return $this->render('proveidor/create.html.twig');
    }

    /**
     * @Route("/store", name="app_guardar_proveidor")
     */
    public function store(Request $request): Response
    {
        $proveidor = new Proveidor();
        $proveidor->setNom($request->request->get('nom'));
        $proveidor->setEmail($request->request->get('email'));
        $proveidor->setTelefon($request->request->get('telefon'));
        $proveidor->setTipus($request->request->get('tipus'));
        $proveidor->setActiu($request->request->get('actiu') === 'on');
        $proveidor->setDataCreacio(new DateTimeImmutable());
        $proveidor->setDataActualitzacio(new DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($proveidor);
        $em->flush();
        $this->addFlash('sucess', 'Proveidor afegit correctament!');
        return $this->redirectToRoute('app_index_proveidor');
    }

    /**
     * @Route("/delete/{id}",name="app_eliminar_proveidor")
     */
    public function delete(int $id, ProveidorRepository $proveidorRepository): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        if (null === $proveidor) {
            throw $this->createNotFoundException();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($proveidor);
        $em->flush();
        $this->addFlash('sucess', 'Proveïdor eliminat correctament!');
        return $this->redirectToRoute('app_index_proveidor');
    }
}
