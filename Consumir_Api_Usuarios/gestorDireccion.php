<?php

function hacerPeticionHTTPDireccion ($url, $metodo, $arreglo) {
    
    $curl = curl_init();
    $header = array('Content-Type: application/json');
    
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $metodo,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_POSTFIELDS => json_encode($arreglo)
    ]);
    
    $respuesta2 = curl_exec($curl);
    
    curl_close($curl);
    
    return $respuesta2;
}

if (isset($_POST['getDirecciones'])) {
    $url = "http://localhost:8080/direccion";
    $metodo = "GET";
    $respuesta2 = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['getDireccionPorId'])) {
    $id = $_POST['idDireccion'];
    $url = "http://localhost:8080/direccion/".$id;
    $metodo = "GET";
    $respuesta2 = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['getDireccionesPorIdUsuario'])) {
    $id = $_POST['idOculto'];
    $url = "http://localhost:8080/direccion/consulta?usuario=".$id;
    $metodo = "GET";
    $respuesta2 = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['getDireccionesPorTipo'])) {
    $tipo = $_POST['typeDireccion'];
    $url = "http://localhost:8080/direccion/consultaTipo?tipo=".$tipo;
    $metodo = "GET";
    $respuesta2 = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['saveDireccion'])) {
    $id = $_POST['usuarioDireccion'];
    $url = "http://localhost:8080/usuario/".$id;
    $url2 = "http://localhost:8080/direccion";
    $metodo = "GET";
    $metodo2 = "POST";
    $usuario = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos = json_decode($usuario, true);
    $postData = array("id" => $_POST['numeroDireccion'], "calle" => $_POST['calleDireccion'], "numero" => $_POST['numeracionDireccion'], "localidad" => $_POST['localidadDireccion'], "ciudad" => $_POST['ciudadDireccion'], "pais" => $_POST['paisDireccion'], "tipo" => $_POST['tipoDireccion'], "usuario" => array("id" => $datos['id'], "nombre" => $datos['nombre'], "apellido" => $datos['apellido'], "email" => $datos['email']));
    $respuesta2 = hacerPeticionHTTPDireccion($url2, $metodo2, $postData);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['updateDireccion'])) {
    $id = $_POST['usuarioDireccion'];
    $url = "http://localhost:8080/usuario/".$id;
    $url2 = "http://localhost:8080/direccion";
    $metodo = "GET";
    $metodo2 = "PUT";
    $usuario = hacerPeticionHTTPDireccion($url, $metodo, null);
    $datos = json_decode($usuario, true);
    $postData = array("id" => $_POST['numeroDireccion'], "calle" => $_POST['calleDireccion'], "numero" => $_POST['numeracionDireccion'], "localidad" => $_POST['localidadDireccion'], "ciudad" => $_POST['ciudadDireccion'], "pais" => $_POST['paisDireccion'], "tipo" => $_POST['tipoDireccion'], "usuario" => array("id" => $datos['id'], "nombre" => $datos['nombre'], "apellido" => $datos['apellido'], "email" => $datos['email']));
    $respuesta2 = hacerPeticionHTTPDireccion($url2, $metodo2, $postData);
    $datos2 = json_decode($respuesta2, true);
}
if (isset($_POST['deleteDireccionPorId'])) {
    $id = $_POST['idOculto'];
    $url = "http://localhost:8080/direccion/".$id;
    $metodo = "DELETE";
    $respuesta2 = hacerPeticionHTTPDireccion($url, $metodo, null);
}

