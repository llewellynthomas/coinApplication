<?php

namespace LlewellynThomas\Bundle\CoinCalculatorBundle\Controller;

use LlewellynThomas\Bundle\CoinCalculatorBundle\Form\Type\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CalculatorController extends Controller
{

    /**
     * @Template()
     * @Route("/", name="home")
     *
     * @return array
     */
    public function homeAction()
    {
        return [];
    }

    /**
     * @param Request $request
     *
     * @Template()
     * @Route("/calculator/coin", name="calculator_coin")
     * @return array
     */
    public function calculatorAction(Request $request)
    {

        $form = $this->createForm(CalculatorType::class, null, ['actionPath' => $this->generateUrl('calculator_coin')]);
        $form->handleRequest($request);

        $coins = [];
        if ($form->isValid() && $request->getMethod() == 'POST') {
            $formData = $form->getData();
            $coins = $this->get('coin.coin_counter')->calculateCoins($formData['currency'], $formData['amount']);

        }

        return[
            'form' => $form->createView(),
            'coins' => $coins,
        ];
    }
}