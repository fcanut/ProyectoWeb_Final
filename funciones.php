<?php
include 'conexionn.php';

class Usuario {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function agregarUsuario( $usuario, $correo_electronico, $contrasena) {
        $query = "INSERT INTO registro_usuario (usuario, correo_electronico, contrasena) VALUES (?, ?, ?)";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("sss", $usuario, $correo_electronico, $contrasena);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al agregar usuario: " . $stmt->error;
            return false;
        }
    }
}

class reservacion {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function agregarReservacion( $cui, $mesas, $sillas, $fecha_reservacion, $direccion_evento, $tipo_evento, $metodo_pago, $color_evento) {
        $query = "INSERT INTO reservacion(cui, mesas, sillas, fecha_reservacion, direccion_evento, tipo_evento, metodo_pago, color_evento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("siissiis", $cui, $mesas, $sillas, $fecha_reservacion, $direccion_evento, $tipo_evento, $metodo_pago, $color_evento);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al agregar usuario: " . $stmt->error;
            return false;
        }
    }
}

class tipo_cobro{
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function agregarCobro($nombre) {
        $query = "INSERT INTO tipo_cobro(nombre_cobro) VALUES (?)";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al agregar Tipo de Cobro: " . $stmt->error;
            return false;
        }
    }
}

class eventoss{
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function agregarEvento($nombre, $costo) {
        $query = "INSERT INTO tipo_evento (nombre_evento, costo_evento) VALUES (?, ?)";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("si", $nombre, $costo);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al agregar evento: " . $stmt->error;
            return false;
        }
    }
}


class clientes {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function agregarCliente( $cui, $nombre, $apellido, $correo_electronico, $telefono, $sexo) {
        $query = "INSERT INTO clientes(cui, nombre, apellido, correo_electronico, telefono, sexo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("ssssss", $cui, $nombre, $apellido, $correo_electronico, $telefono, $sexo);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al agregar cliente: " . $stmt->error;
            return false;
        }
    }
}

class listar_cliente {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function listarClientes() {
        $clientes = array();

        // Realiza una consulta SQL
        $query = "SELECT * FROM clientes";
        $resultado = $this->conexionn->query($query);


        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $clientes[] = $fila;
            }
            $resultado->free();
        } else {
            echo "Error al listar clientes: " . $this->conexionn->error;
        }

        return $clientes;
    }

}



class listar_Eventos {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function listarMisEventos() {
        $event = array();

        // Realiza una consulta SQL
        $query = "SELECT * FROM tipo_evento";
        $resultado = $this->conexionn->query($query);


        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $event[] = $fila;
            }
            $resultado->free(); 
        } else {
            echo "Error al listar Eventos: " . $this->conexionn->error;
        }

        return $event;
    }

}


class listarme_eventos {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function listarEventos() {
        $eventos = array();

        // Realiza una consulta SQL
        $query = "SELECT CONCAT(clientes.cui, ' - ', clientes.nombre, ' ', clientes.apellido) AS cui_nombre_apellido, sillas, mesas, tipo_evento.nombre_evento, tipo_cobro.nombre_cobro, reservacion.total_pagar, clientes.telefono, clientes.correo_electronico
        FROM reservacion
        INNER JOIN clientes ON reservacion.cui = clientes.cui
        INNER JOIN tipo_evento ON reservacion.tipo_evento = tipo_evento.id
        INNER JOIN tipo_cobro ON reservacion.metodo_pago = tipo_cobro.id;";
        $resultado = $this->conexionn->query($query);


        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $eventos[] = $fila;
            }
            $resultado->free(); // Liberar el resultado
        } else {
            echo "Error al listar Eventos: " . $this->conexionn->error;
        }

        return $eventos;
    }

}



class listar_EventoCosto {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function listarMisCostosEvento() {
        $eventos = array();

        // Realiza una consulta SQL
        $query = "SELECT * FROM tipo_evento";
        $resultado = $this->conexionn->query($query);


        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $eventos[] = $fila;
            }
            $resultado->free(); 
        } else {
            echo "Error al listar tus Eventos: " . $this->conexionn->error;
        }

        return $eventos;
    }

}


class listar_cobros {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function listarMisCobros() {
        $cobro = array();

        // Realiza una consulta SQL
        $query = "SELECT * FROM tipo_cobro";
        $resultado = $this->conexionn->query($query);


        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $cobro[] = $fila;
            }
            $resultado->free(); 
        } else {
            echo "Error al listar tus Cobros: " . $this->conexionn->error;
        }

        return $cobro;
    }

}



class cobro {
    private $conexionn;
    public function __construct($conexionn) {
        $this->conexion = $conexionn;
    }

    public function obtenerUnCobro($id)
    {
        // Realiza una consulta SQL
        $query = "SELECT * FROM tipo_cobro where id=".$id."";
        $resultado = $this->conexion->query($query);
        if ($resultado)
         {
            $cobrame = $resultado->fetch_assoc();
            $resultado->free(); 
            return $cobrame;
        }
         else {
            echo "Error al listar Cobro: " . $this->conexionn->error;
            return null;
        }  
    }
    public function actualizarCobro($id, $nombre, $estado) {
        $query = "UPDATE tipo_cobro SET nombre_cobro = ?, estado = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sii", $nombre, $estado, $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar cobro: " . $stmt->error;
            return false;
        }
    }
}

class MisEventos {
    private $conexionn;
    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function obtenerUnEvento($id)
    {
        // Realiza una consulta SQL
        $query = "SELECT * FROM tipo_evento where id=".$id."";
        $resultado = $this->conexionn->query($query);
        if ($resultado)
         {
            $avent = $resultado->fetch_assoc();
            $resultado->free(); // Liberar el resultado
            return $avent;
        }
         else {
            echo "Error al listar Evento: " . $this->conexionn->error;
            return null;
        }  
    } 
    
    public function actualizarEvento($id, $nombre, $costo, $estado) {
        $query = "UPDATE tipo_evento SET nombre_evento = ?, costo_evento = ?, estado = ? WHERE id = ?";
        $stmt = $this->conexionn->prepare($query);
        $stmt->bind_param("siii", $nombre, $costo, $estado, $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar Evento: " . $stmt->error;
            return false;
        }
    }
}



class MisCliente {
    private $conexionn;
    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }

    public function obtenerUnCliente($id){
    // Realiza una consulta SQL
    $query = "SELECT * FROM clientes where cui=".$id."";
    $resultado = $this->conexionn->query($query);
    if ($resultado)
     {
        $client = $resultado->fetch_assoc();
        $resultado->free(); // Liberar el resultado
        return $client;
    }
     else {
        echo "Error al listar Cliente: " . $this->conexionn->error;
        return null;
    }  
} 

public function actualizarCliente($id, $nombre, $apellido, $correo, $telefono, $sexo) {
    $query = "UPDATE clientes SET nombre = ?, apellido = ?, correo_electronico = ?, telefono = ?, sexo = ? WHERE cui = ?";
    $stmt = $this->conexionn->prepare($query);
    $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $telefono, $sexo, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        echo "Error al actualizar Cliente: " . $stmt->error;
        return false;
    }
}
}


class listar_fechas {
    private $conexionn;

    public function __construct($conexionn) {
        $this->conexionn = $conexionn;
    }
    public function listarFechas($fecha1, $fecha2) {
        $lista = array();
        // Realiza una consulta SQL
        $query = "SELECT r.*, te.nombre_evento AS tipo_evento_nombre, tc.nombre_cobro AS metodo_pago_nombre
        FROM reservacion r
        JOIN tipo_evento te ON r.tipo_evento = te.id
        JOIN tipo_cobro tc ON r.metodo_pago = tc.id
        WHERE r.fecha_reservacion BETWEEN '$fecha1' AND '$fecha2'";;
        $resultado = $this->conexionn->query($query);
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $lista[] = $fila;
            }
            $resultado->free(); // Liberar el resultado
        } else {
            echo "Error al listar Fechas: " . $this->conexionn->error;
        }
        return $lista;
    }
}



?>

