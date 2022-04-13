<?php

namespace App\Form;

use App\Entity\Sponsor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;


class SponsorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'required' => true,
                'constraints' => [new Length(['min' => 4 , 'max' => 100 ])],
            ])
            ->add('adresse',TextareaType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 4 , 'max' => 100 ])],
            ])
            ->add('numtel',TextareaType::class,[
                'required' => true,
                'constraints' => [new Length(['min' => 8 , 'max' => 8 ])],

            ])
            ->add('email',EmailType::class)


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsor::class,
        ]);
    }
}
