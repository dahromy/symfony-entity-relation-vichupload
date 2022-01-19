<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('description', TextareaType::class)
            ->add('attachments', CollectionType::class, array(
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => InvoiceAttachmentType::class,
                'by_reference' => false
            ))
            ->add('addInvoiceAttachment', ButtonType::class, ['attr' => ['class' => 'btn btn-primary btn-sm float-right add-new']])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-success btn-sm add-new']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
