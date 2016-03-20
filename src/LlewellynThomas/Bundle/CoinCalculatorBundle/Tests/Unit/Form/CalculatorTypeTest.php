<?php

namespace LlewellynThomas\Bundle\CoinCalculatorBundle\Tests\Unit\Form;

use LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type\CalculatorType;
use LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type\CurrencyType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class CalculatorTypeTest
 * @package LlewellynThomas\Bundle\CoinCalculatorBundle\Tests\Unit\Form
 */
class CalculatorTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'currency' => 'usd',
            'amount' => '200',
        );

        $form = $this->factory->create(CalculatorType::class);

        // submit the data
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(['currency' => 'usd','amount' => '20000.00'], $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (\array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    protected function getExtensions()
    {
        return [
            new PreloadedExtension([new CurrencyType(['usd' => []])], []),
        ];
    }

}
