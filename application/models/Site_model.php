<?php
class Site_model extends CI_Model
{

    public function loginUser($data)
    {
        $this->db->select("*");
        $this->db->from("profesores");
        $this->db->where("username", $data["username"]);
        $this->db->where("password", md5($data["password"]));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            $this->db->select("*");
            $this->db->from("alumnos");
            $this->db->where("username", $data["username"]);
            $this->db->where("password", md5($data["password"]));

            $queryalumno = $this->db->get();

            if ($queryalumno->num_rows() > 0) {
                return $queryalumno->result();
            }

            return NULL;
        }
    }

    public function insertProfesor()
    {
        $array = array(
            "nombre" => "David",
            "apellidos" => "Navarro",
            "curso" => 3
        );

        //Para insertar en la BD hacemos lo siguiente:
        //(nombre de la tabla, datos)
        $this->db->insert("profesores", $array);
    }

    public function getProfesores()
    {
        $this->db->select("*");
        $this->db->from("profesores");
        //$this->db->where("id",1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function updateProfesores()
    {
        $array = array(
            "nombre" => "David",
            "apellidos" => "Navarro López",
            "curso" => 1
        );

        $this->db->where("id", 1);
        $this->db->update("profesores", $array);
    }

    public function getAlumnos($curso)
    {
        $this->db->select("*");
        $this->db->from("alumnos");
        $this->db->where("curso", $curso);
        $this->db->where("deleted", 0);

        //Guardamos en una variable el resultado
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }

    }

    public function deleteAlumno($id)
    {
        $array = array(
            "deleted" => 1
        );

        $this->db->where("id", $id);
        $this->db->update("alumnos", $array);
    }

    public function uploadTarea($data, $archivo = null)
    {
        $array = array(
            "nombre" => $data['nombre'],
            "descripcion" => $data['descripcion'],
            "fecha_final" => $data['fecha'],
            "archivo" => empty($archivo) ? "no_imagen.jpg" : $archivo,
            "curso" => $data['curso']
        );

        $this->db->insert("tareas", $array);
    }

    public function getTareas($curso)
    {
        $this->db->select("*");
        $this->db->from("tareas");
        $this->db->where("curso", $curso);
        $this->db->order_by("fecha_final", "ASC");

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function getUsuarios($tipo, $curso)
    {
        $this->db->select("*");
        if ($tipo == "profesor") {
            $this->db->from("alumnos");
        } else {
            $this->db->from("profesores");
        }
        $this->db->where("curso", $curso);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function insertMensaje($data, $iduser)
    {
        $array = array(
            "texto" => $data['mensaje'],
            "id_from" => $iduser,
            "id_to" => $data['id_to'],
        );

        $this->db->insert("mensajes", $array);
    }

    public function getToken($id, $tipo)
    {
        $this->db->select("*");
        $this->db->where("id", $id);

        if ($tipo == "profesor") {
            $this->db->from("profesores");
        } else {
            $this->db->from("alumnos");
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result[0]->token_mensaje;
        } else {
            return NULL;
        }
    }

    public function getMensajes($token)
    {
        $this->db->select("*");
        $this->db->from("mensajes");
        $this->db->where("id_to", $token);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function getTextMensaje($idmensaje) {
        $this->db->select("*");
        $this->db->from("mensajes");
        $this->db->where("id", $idmensaje);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function getNombre($id)
    {
        $this->db->select("*");
        $this->db->from("alumnos");
        $this->db->where("token_mensaje", $id);

        $query1 = $this->db->get_compiled_select();

        $this->db->select("*");
        $this->db->from("profesores");
        $this->db->where("token_mensaje", $id);

        $query2 = $this->db->get_compiled_select();

        $query = $this->db->query($query1 . " UNION " . $query2);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
}