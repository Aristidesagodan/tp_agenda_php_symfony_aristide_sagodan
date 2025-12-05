<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    #[Route('/init-db', name: 'init_db')]
    public function init(EntityManagerInterface $em): Response
    {
        // --- Création des catégories ---
        $cat1 = new Category();
        $cat1->setTitle('famille');

        $cat2 = new Category();
        $cat2->setTitle('amis');

        $cat3 = new Category();
        $cat3->setTitle('travail');

        $em->persist($cat1);
        $em->persist($cat2);
        $em->persist($cat3);

        // --- Création de 5 contacts ---
        $contactsData = [
            ['nom' => 'Dupont', 'prenom' => 'Jean', 'telephone' => '0123456789', 'adresse' => '1 rue A', 'ville' => 'Paris', 'age' => 25, 'category' => $cat1],
            ['nom' => 'Martin', 'prenom' => 'Claire', 'telephone' => '0123456788', 'adresse' => '2 rue B', 'ville' => 'Lyon', 'age' => 30, 'category' => $cat2],
            ['nom' => 'Durand', 'prenom' => 'Paul', 'telephone' => '0123456777', 'adresse' => '3 rue C', 'ville' => 'Marseille', 'age' => 40, 'category' => $cat3],
            ['nom' => 'Petit', 'prenom' => 'Sophie', 'telephone' => '0123456766', 'adresse' => '4 rue D', 'ville' => 'Nice', 'age' => 22, 'category' => $cat1],
            ['nom' => 'Moreau', 'prenom' => 'Lucas', 'telephone' => '0123456755', 'adresse' => '5 rue E', 'ville' => 'Bordeaux', 'age' => 35, 'category' => $cat2],
        ];

        foreach ($contactsData as $data) {
            $contact = new Contact();
            $contact->setNom($data['nom']);
            $contact->setPrenom($data['prenom']);
            $contact->setTelephone($data['telephone']);
            $contact->setAdresse($data['adresse']);
            $contact->setVille($data['ville']);
            $contact->setAge($data['age']);
            $contact->setCategory($data['category']);
            $em->persist($contact);
        }

        // --- Sauvegarde en base ---
        $em->flush();

        return new Response('Base initialisée avec succès ✅ 3 catégories et 5 contacts créés.');
    }
}
