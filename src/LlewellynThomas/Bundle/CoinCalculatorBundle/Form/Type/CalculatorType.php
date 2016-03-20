<?php

namespace LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CalculatorType
 * @package LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type
 */
class CalculatorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($options['actionPath'])
            ->setMethod('POST')
            ->add('currency', CurrencyType::class)
            ->add('amount' , MoneyType::class, ['divisor' => 100, 'grouping' => true, 'currency' => false])
            ->add('submit', SubmitType::class, ['label' => 'coin.submit'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'actionPath' => '',
        ]);
    }
}