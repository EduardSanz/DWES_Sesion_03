<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{

    private $catRepository;

    public function __construct(CategoriasRepository $catRepository){
        $this->catRepository = $catRepository;
    }


    /**
     * @Route("/categoria", name="create_categoria")
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function createController(EntityManagerInterface  $entityManager, Request $request){
        $categoriaNombre = $request->get("categoria");
        if (!$categoriaNombre) {
            $response = new JsonResponse();
            $response->setData([
                'success' => false,
                'data' => null
            ]);
            return $response;
        }

        $categoria = new Categorias();
        $categoria->setCategoria($categoriaNombre);

        $entityManager->persist($categoria);
        $entityManager->flush();

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $categoria->getId(),
                    'categoria' => $categoria->getCategoria()
                ]
            ]
        ]);
        $response->setStatusCode(200);
        return $response;
    }

    /**
     * @Route("/categoria/list", name="categoria_list")
     * @return JsonResponse
     */
    public function listCategoria(){
        $catagorias = $this->catRepository->findAll();
        $catagoriasArray = [];
        foreach ($catagorias as $cat) {
            $catagoriasArray[] = [
                'id' => $cat->getId(),
                'categoria' => $cat->getCategoria()
            ] ;
        }

        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => $catagoriasArray
        ]);
        $response->setStatusCode(200);
        return $response;
    }
}
