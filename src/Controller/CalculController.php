<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculController extends AbstractController
{
    #[Route('/calcul/{op}', name: 'app_calcul')]
    public function index(string $op = " ", Request $request): Response
    {
        $var1 = $request->query->get('var1');
        $var2 = $request->query->get('var2');
        $result = 0;

        switch ($op) {
            case 'plus':
                $result = $var1 + $var2;
                $message = "$var1 + $var2 = $result";
                break;

            case 'moins':
                $result = $var1 - $var2;
                $message = "$var1 - $var2 = $result";
                break;

            case 'fois':
                $result = $var1 * $var2;
                $message = "$var1 x $var2 = $result";
                break;

            case 'div':
                if ($var1 == 0 || $var2 == 0) {
                    $message = "Infinity";
                } else {
                    $result = $var1 / $var2;
                    $message = "$var1 / $var2 = $result";
                }
                break;

            default:
                $message = "Erreur ";
                break;
        }

        return $this->render('calcul/index.html.twig', [
            'controller_name' => $message,
        ]);
    }
}
