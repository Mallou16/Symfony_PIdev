<?php

namespace App\Form;
use App\Entity\Materiel;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'attr' => array('style' => 'width: 400px'),
            ])
            ->add('quantite',NumberType::class,[
                    'attr' => array('style' => 'width: 400px')
            ])
            ->add('prix',NumberType::class,[
                    'attr' => array('style' => 'width: 400px')
            ])
            ->add('etat',TextType::class,[
                    'attr' => array('style' => 'width: 400px')
            ])
            ->add('description',TextareaType::class,[
                    'attr' => array('style' => 'width: 400px')
            ])
            ->add('image',FileType::class, array(
                'data_class' => null
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
