<?php

namespace App\Controller;
use App\Security\AppCustomAuthenticator;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use App\Repository\ContactRepository; // ✔ On importe le repository pour accéder aux données
use App\Entity\Contact;  // ✔ L’entité Contact
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;


final class HomeController extends AbstractController
{
    
    #[Route('/base', name: 'base')]
    public function base(): Response
    {
          return $this->render('base.html.twig');
    }

     
   /* #[Route('/', name: 'home')]
    public function home(): Response
    {

       $contacts = [
       ["id" => 1, "nom" => "Dupont", "prenom" => "Jean", "telephone" => "0601020304"],
       ["id" => 2, "nom" => "Martin", "prenom" => "Lucie", "telephone" => "0605060708"],
       ["id" => 3, "nom" => "Durand", "prenom" => "Paul", "telephone" => "0611223344"],
    ];
    return $this->render('home/home.html.twig', [
    'contacts' => $contacts
    ]);
    }*/

    // ✔ Route /contact/{id} => affiche le détail d’un contact
   /* #[Route('/contact/{id}', name: 'contact_show')]
    public function contactShow(int $id): Response
    {
    $contacts = [
        1 => ["id" => 1, "nom" => "Dupont", "prenom" => "Jean", "telephone" => "0601020304"],
        2 => ["id" => 2, "nom" => "Martin", "prenom" => "Lucie", "telephone" => "0605060708"],
        3 => ["id" => 3, "nom" => "Durand", "prenom" => "Paul", "telephone" => "0611223344"],
    ];

    // Sécurise en cas d'ID inconnu
    if (!isset($contacts[$id])) {
        throw $this->createNotFoundException("Contact non trouvé");
    }
    // ✔ Symfony récupère automatiquement le contact correspondant à {id}
    return $this->render('home/contact.html.twig', [
        'contact' => $contacts[$id]
    ]);
    
    }*/

     #[Route('/insert-test', name: 'insert_test')]
     public function insert(EntityManagerInterface $em): Response
    {
      $contactsData = [
        ["Dupont", "Jean", "0601020304", "12 rue des Fleurs", "Paris", 32],
        ["Martin", "Lucie", "0605060708", "5 avenue Victor Hugo", "Lyon", 28],
        ["Durand", "Paul", "0611223344", "22 boulevard Voltaire", "Marseille", 45],
        ["Moreau", "Sophie", "0677889900", "18 rue Pasteur", "Toulouse", 30],
        ["Bernard", "Lucas", "0699001122", "7 rue Lafayette", "Nice", 26],
     ];

      foreach ($contactsData as $data) {
        $c = new Contact();
        $c->setNom($data[0]);
        $c->setPrenom($data[1]);
        $c->setTelephone($data[2]);
        $c->setAdresse($data[3]);
        $c->setVille($data[4]);
        $c->setAge($data[5]);

        $em->persist($c);
       }

        $em->flush();

        return new Response("Contacts ajoutés !");
     }

       // ✔ Route de la page d’accueil
       
       #[Route('/', name: 'home')]
        public function index(ContactRepository $repo): Response
       {
          
        // ✔ On récupère TOUS les contacts en base via Doctrine
        $contacts = $repo->findAll();

        // ✔ QueryBuilder = outil flexible pour faire des requêtes SQL
          $contacts = $repo->createQueryBuilder('c')
         ->where('c.age > 18') // ✔ Condition : seulement > 18 ans
         ->getQuery()
         ->getResult();  // ✔ On récupère les résultats
          
           // ✔ On envoie les données au template Twig "home.html.twig"
          return $this->render('home/home.html.twig', [
           'contacts' => $contacts
           ]);
        }

        #[Route('/contact/{id}', name: 'contact_show')]
        public function show(Contact $contact): Response
        {
         return $this->render('home/contact.html.twig', [
        'contact' => $contact
        ]);
        }

        
        // ✔ Route /contact/{id}/edit => met à jour le téléphone
        //#[Route('/contact/{id}/edit', name: 'contact_edit')]
        //public function edit(Contact $contact, EntityManagerInterface $em): Response
        //{
         // ✔ On modifie uniquement le numéro pour l'exercice
         // $contact->setTelephone("New number !");

         // sauvegarde
         //$em->flush();

         // ✔ On retourne à l'accueil
        //  return $this->redirectToRoute('home');
       // }

        // ✔ Route /contact/{id}/delete => supprime un contact de la base
        #[Route('/contact/{id}/delete', name: 'contact_delete')]
         public function delete(Contact $contact, EntityManagerInterface $em): Response
        {
           // ✔ On supprime l’objet Contact
           $em->remove($contact);
           // ✔ On valide la suppression
           $em->flush();
           // ✔ Retour à la page d'accueil
         return $this->redirectToRoute('home');
        }




     
  
    // #[Route('/home', name: 'app_home')]
    // public function index(): Response
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

}