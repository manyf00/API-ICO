<?php

namespace App\Controller;

use App\Repository\UsuariosRepository;
use App\Repository\HospitalRepository;
use App\Repository\MedicacionRepository;
use App\Repository\CitaRepository;
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
    private $id=1;


    private $usuariosRepository;
    private $hospitalRepository;
    private $citaRepository;
    private $medicacionRepository;

    public function __construct(UsuariosRepository $usuariosRepository, HospitalRepository $hospitalRepository, CitaRepository $citaRepository, MedicacionRepository $medicacionRepository )
    {
        $this->usuariosRepository = $usuariosRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->citaRepository = $citaRepository;
        $this->medicacionRepository = $medicacionRepository;
    }
    /**
     * @Route("perfil", name="perfil", methods={"GET"})
     */
    public function getPerfil() : JsonResponse
    {

        $user = $this->usuariosRepository->findOneBy(['id' => $this->id]);
        $data=[
            'id'=>$user->getId(),
            'nombre'=>$user->getNombre(),
            'apellidos'=>$user->getApellidos(),
            'genero'=>$user->getGenero(),
            'correo'=>$user->getCorreo(),
            'telefonos'=>$user->getTelefonos(),
            'dataNeixement'=>$user->getDataNeixement(),
        ];
        //var_dump($data);
        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("hospital", name="hospital", methods={"GET"})
     */
    public function getHospital() : JsonResponse
    {

        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $hospital=$this->hospitalRepository->findOneBy(['id'=>$user->getHospital()]);
        $data=[
            'nombre'=>$hospital->getNombre(),
            'nombreUnidad'=>$hospital->getNombreUnidad(),
            'telefonos'=>$hospital->getTelefonos(),
            'diasAbiertos'=>$hospital->getDiasAbiertos(),
            'horaInicio'=>$hospital->getHoraInicio(),
            'horaFinal'=>$hospital->getHoraFinal(),
            'correos'=>$hospital->getCorreos(),
            'ubicacion'=>$hospital->getUbicacion(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("citas", name="citas", methods={"GET"})
     */
    public function getCita() : JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $citas=$this->citaRepository->findBy(['usuario'=>$user]);
        $data=[];
        foreach($citas as $cita){
            $data[]=[
            'fecha'=>$cita->getFecha(),
            'edificio'=>$cita->getEdificio(),
            'box'=>$cita->getBox(),
            'indicaciones'=>$cita->getIndicaciones(),
            'estado'=>$cita->getEstado(),
            'hospital'=>$cita->getHospital()->getNombre(),
            'ubicacion'=>$cita->getHospital()->getUbicacion(),
        ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("medicamentos", name="medicamentos", methods={"GET"})
     */
    public function getMedicamentos() : JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        var_dump($user);
        $medicamentos=$this->medicacionRepository->findBy(['usuario'=>$user]);
        $data=[];
        foreach($medicamentos as $medicamento){
            $data[]=[
            'id'=>$medicamento->getId(),
            'nodmbre'=>$medicamento->getNombre(),
        ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("medicamento/{$id}", name="medicamento", methods={"GET"})
     */
    public function getMedicamento($id) : JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $medicamento=$this->medicacionRepository->findByfindOneBy(['id'=>$id]);
        $data=[
            'nodmbre'=>$medicamento->getNombre(),
            'compuestoActivo'=>$medicamento->getCompuestoActivo(),
            'comprimidosTotales'=>$medicamento->getComprimidosTotales(),
            'usosDiarios'=>$medicamento->getUsosDiarios(),
            'dosis'=>$medicamento->getDosis(),
            'observaciones'=>$medicamento->getObservaciones(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
