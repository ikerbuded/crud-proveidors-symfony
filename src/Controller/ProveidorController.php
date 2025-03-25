<?php

namespace App\Controller;

use App\Entity\Proveidor;
use App\Repository\ProveidorRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function store(Request $request, ValidatorInterface $validator): Response
    {
        $proveidor = new Proveidor();
        $proveidor->setNom($request->request->get('nom'));
        $proveidor->setEmail($request->request->get('email'));
        $proveidor->setTelefon($request->request->get('telefon'));
        $proveidor->setTipus($request->request->get('tipus'));
        $proveidor->setActiu($request->request->get('actiu') === 'on');
        $proveidor->setDataCreacio(new DateTimeImmutable());
        $proveidor->setDataActualitzacio(new DateTime());

        $errors = $validator->validate($proveidor);
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->addFlash('danger', $error->getMessage());
            }
            return $this->redirectToRoute('app_afegir_proveidor');
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($proveidor);
        $em->flush();
        $this->addFlash('success', 'Proveïdor afegit correctament!');
        return $this->redirectToRoute('app_index_proveidor');
    }

    /**
     * @Route("/mostrar/{id}", name="app_mostrar_proveidor")
     */
    public function read(int $id, ProveidorRepository $proveidorRepository): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        if (null === $proveidor) {
            throw $this->createNotFoundException();
        }
        return $this->render('proveidor/show.html.twig', ['id' => $id, 'proveidor' => $proveidor]);
    }

    /**
     * @Route("/editar/{id}", name="app_editar_proveidor")
     */
    public function edit(int $id, ProveidorRepository $proveidorRepository): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        if (null === $proveidor) {
            throw $this->createNotFoundException();
        }
        return $this->render('proveidor/edit.html.twig', ['id' => $id, 'proveidor' => $proveidor]);
    }

    /**
     * @Route("/update/{id}", name="app_actualitzar_proveidor")
     */
    public function update(int $id, ProveidorRepository $proveidorRepository, Request $request, ValidatorInterface $validator): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        if (null === $proveidor) {
            throw $this->createNotFoundException();
        }
        $proveidor->setNom($request->request->get('nom'));
        $proveidor->setEmail($request->request->get('email'));
        $proveidor->setTelefon($request->request->get('telefon'));
        $proveidor->setTipus($request->request->get('tipus'));
        $proveidor->setActiu($request->request->get('actiu') === 'on');
        $proveidor->setDataActualitzacio(new DateTime());

        $errors = $validator->validate($proveidor);
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->addFlash('danger', $error->getMessage());
            }
            return $this->redirectToRoute('app_editar_proveidor', ['id' => $id]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Proveïdor editat correctament!');
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
        $this->addFlash('danger', 'Proveïdor eliminat correctament!');
        return $this->redirectToRoute('app_index_proveidor');
    }
}
