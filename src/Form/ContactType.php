<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('telephone', TextType::class)
            ->add('adresse', TextType::class)
            ->add('ville', TextType::class)
            ->add('age', IntegerType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => 'Catégorie'
            ])

            //Un bouton "Sauvegarder"
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter le contact'
            ]);

            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Le formulaire est utilisé pour créer/éditer un contact
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
