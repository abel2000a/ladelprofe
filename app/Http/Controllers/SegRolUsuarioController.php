<?php


namespace App\Http\Controllers;


use App\SegRolUsuario;

class SegRolUsuarioController extends Controller
{

    /** Listar roles Asignados a un usuario ( lista de checks) */

    public function listar_roles_asignados_usuario($usuarioid)
    {       $lista = SegRolUsuario::lista_roles_asignados_a_usuario($usuarioid);// id del usuario
        $listaRoles = [];
        foreach ($lista as $key => $rol) {
            if ($rol->asignado == '1') {
                $rol->asignado = true;
            } else {
                $rol->asignado = false;
            }
            array_push($listaRoles, $rol);
        }
        $jResponse['success'] = true;
        $jResponse['data']=$listaRoles;
        return response()->json($jResponse);
    }
    /** Listar roles Asignados a un usuario ( lista de checks) */


    /** Asignar roles Asignados a un usuario ( por lista de checks) */
    public function asignar_roles_usuario()
    {   $params = json_decode(file_get_contents("php://input"));
        $seg_rol_id = $params->seg_rol_id;
        $user_id = $params->user_id;
        SegRolUsuario::insertar_roles_usuario($seg_rol_id, $user_id);
        $jResponse['success'] = true;
        $jResponse['data'] = ['items' => 'ok'];

        return response()->json($jResponse);
    }
    /** Asignar roles Asignados a un usuario ( por lista de checks) */
}

