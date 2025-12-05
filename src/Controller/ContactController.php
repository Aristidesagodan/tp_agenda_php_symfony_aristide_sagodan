<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    /**
     * Ajouter un contact
     */
    #[Route('/contact/add', name: 'contact_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();

        // Création du formulaire
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        // Formulaire soumis + validation OK
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($contact);
            $em->flush();

            // Message de succès
            $this->addFlash('success', 'Contact ajouté avec succès');

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/ajouter.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/contact/{id}/edit', name: 'contact_edit')]
    public function edit(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
    // ✔ 1. Le contact existe déjà (Symfony l’a récupéré via {id})

    // ✔ 2. On crée un formulaire pré-rempli avec ce contact
    $form = $this->createForm(ContactType::class, $contact);

    // ✔ 3. On récupère les modifications envoyées
    $form->handleRequest($request);

    // ✔ 4. Si formulaire valide
          if ($form->isSubmitted() && $form->isValid()) {

        // ✔ Doctrine connaît déjà l’objet, donc pas besoin de persist()
        $em->flush();

        // ✔ Message de succès
        $this->addFlash('success', 'Contact modifié avec succès');

        // ✔ Redirection
        return $this->redirectToRoute('home');
        }

    // ✔ On renvoie la page
    return $this->render('contact/modifier.html.twig', [
        'form' => $form->createView()
    ]);
    }


}    