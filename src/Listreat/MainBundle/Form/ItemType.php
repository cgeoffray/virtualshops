<?php

namespace Listreat\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('shop')
            ->add('images', 'collection', array('type'         => new ImageType(),
                                              'allow_add'    => true,
                                              'allow_delete' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Listreat\MainBundle\Entity\Item'
        ));
    }

    public function getName()
    {
        return 'listreat_mainbundle_itemtype';
    }
}
