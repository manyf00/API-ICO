<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $this->UsuariosRepository = $usuariosRepository;
    }
    /**
     * @Route("user/{id}", name="get_one_user", methods={"GET"})
     */
    public function get($id)
    {
        $user = $this->usuariosRepository->findOneBy(['id' => $id]);
        
        $data=[
            'nombre'=>$user->getNombre(),
            'apellidos'=>$user->getApellidos(),
            'genero'=>$user->getGenero(),
            'correo'=>$user->getCorreo(),
            'telefonos'=>$user->getTelefonos(),
            'hospital'=>$user->getHospital()->getNombre()
        ];
        
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
