<?php

namespace App\Controller;

use App\Repository\UsuariosRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsuarioController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */

class UsuarioController
{
    private $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }
    /**
     * @Route("user/{id}", name="get_one_user", methods={"GET"})
     */
    public function get($id) : JsonResponse
    {

        $user = $this->usuariosRepository->findOneBy(['id' => $id]);
        echo "he entrado";
        $data=[
            'id'=>$user->getId(),
            'nombre'=>$user->getNombre(),
            'apellidos'=>$user->getApellidos(),
            'genero'=>$user->getGenero(),
            'correo'=>$user->getCorreo(),
            'telefonos'=>$user->getTelefonos(),
            'hospital'=>$user->getHospital()->getNombre()
        ];
        //var_dump($data);
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
