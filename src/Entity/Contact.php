<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Category;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(min: 2, minMessage: "Nom invalide (au moins 2 lettres)")]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(min:2, minMessage: "Prénom invalide (au moins 2 lettres)")]
    private ?string $prenom = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    private ?string $telephone = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $ville = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Range(
        min: 15,
        max: 120,
        notInRangeMessage: "L'age doit être compris entre 15 et 120 ans"
    )]
    private ?int $age = null;

    // ✅ Relation correcte
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // --- Getters et Setters ---
    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(string $telephone): self { $this->telephone = $telephone; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(string $adresse): self { $this->adresse = $adresse; return $this; }

    public function getVille(): ?string { return $this->ville; }
    public function setVille(string $ville): self { $this->ville = $ville; return $this; }

    public function getAge(): ?int { return $this->age; }
    public function setAge(int $age): self { $this->age = $age; return $this; }

    public function getCategory(): ?Category { return $this->category; }
    public function setCategory(?Category $category): self { $this->category = $category; return $this; }
}
