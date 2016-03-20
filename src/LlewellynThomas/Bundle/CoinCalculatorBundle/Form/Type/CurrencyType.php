<?php

namespace LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CurrencyType
 * @package LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type
 */
class CurrencyType extends AbstractType
{
    /**
     * @var array
     */
    private $config;

    /**
     * CurrencyType constructor.
     * @param $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }


    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => $this->getChoices(),
        ]);
    }

    /**
     * @return array
     */
    private function getChoices()
    {
        $currencies = [];
        foreach ($this->config as $currency => $coins) {
            $currencies['coin.' . $currency] = $currency;
        }

        return $currencies;
    }
}