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
        $citas=$user->getCitas();
        $data=[];
        foreach($citas as $cita){
            $data[]=[
                'id'=>$cita->getId(),
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
        //var_dump($user);
        $medicamentos=$user->getMedicacions();
        foreach($medicamentos as $medicamento){
            $data[]=[
            'id'=>$medicamento->getId(),
            'nodmbre'=>$medicamento->getNombre(),
        ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("medicamento/{id}", name="medicamento", methods={"GET"})
     */
    public function getMedicamento($id) : JsonResponse
    {
        $medicamento=$this->medicacionRepository->findOneBy(['id'=>$id]);
        $data=[
            'nombre'=>$medicamento->getNombre(),
            'compuestoActivo'=>$medicamento->getCompuestoActivo(),
            'comprimidosTotales'=>$medicamento->getComprimidosTotales(),
            'usosDiarios'=>$medicamento->getUsosDiarios(),
            'dosis'=>$medicamento->getDosis(),
            'observaciones'=>$medicamento->getObservaciones(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("perfil", name="update_perfil", methods={"PUT"})
     */
    public function updatePerfil(Request $request): JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $data = json_decode($request->getContent(), true);

        empty($data['nombre']) ? true : $user->setNombre($data['nombre']);
        empty($data['apellidos']) ? true : $user->setApellidos($data['apellidos']);
        empty($data['genero']) ? true : $user->setGenero($data['genero']);
        empty($data['correo']) ? true : $user->setCorreo($data['correo']);
        empty($data['telefonos']) ? true : $user->setTelefonos($data['telefonos']);
        empty($data['dataNeixement']) ? true : $user->setDataNeixement(new \DateTime($data['dataNeixement']));
        $updatedUser = $this->usuariosRepository->updateUsuario($user);

		return new JsonResponse(['status' => 'Usuari actualitzat!'], Response::HTTP_OK);
    }

    /**
     * @Route("cita/{id}", name="update_cita", methods={"PUT"})
     */
    public function updateCita(Request $request): JsonResponse
    {
        $cita = $this->citaRepository->findOneBy(['id'=>$this->id]);
        $data = json_decode($request->getContent(), true);

        empty($data['fecha']) ? true : $cita->setFecha(new \DateTime($data['fecha']));
        empty($data['edificio']) ? true : $cita->setEdificio($data['edificio']);
        empty($data['box']) ? true : $cita->setBox($data['box']);
        empty($data['indicaciones']) ? true : $cita->setIndicaciones($data['indicaciones']);
        empty($data['estado']) ? true : $cita->setEstado($data['estado']);
        //falta hospital

        $updatedCita = $this->citaRepository->updateCita($cita);

		return new JsonResponse(['status' => 'Usuari actualitzat!'], Response::HTTP_OK);
    }

}
