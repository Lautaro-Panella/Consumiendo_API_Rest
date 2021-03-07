<?php include 'gestorUsuario.php';?>
<?php include 'gestorDireccion.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Consumir API Rest</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: #EDEDED">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a href="#" class="navbar-brand">SISTEMA DE USUARIOS/DIRECCIONES - CONSUMIENDO API Rest</a>
            </div>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Ir a Usuarios</a>
            </li>
        </nav>
        <div class="container p-3">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="form-group">
                            <button type="submit" name="getDirecciones"class="btn btn-success btn-block">VER TODAS LAS DIRECCIONES&nbsp;<i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="number" name="idDireccion" id="button-addon1" class="form-control1" placeholder="Consultar por ID" required/>
                            <button type="submit" name="getDireccionPorId" aria-describedby="button-addon1" class="btn btn-success btn-block"><i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="text" name="typeDireccion" id="button-addon2" class="form-control1" placeholder="Consultar por Tipo" required/>
                            <button type="submit" name="getDireccionesPorTipo" aria-describedby="button-addon2" class="btn btn-success btn-block"><i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container p-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="number" name="numeroDireccion" id="button-addon3" class="form-control1" placeholder="Ingrese ID" required/>
                                <button type="submit" name="updateDireccion" aria-describedby="button-addon3" class="btn btn-success btn-block"><i class="fas fa-pencil-alt"></i></button>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="calleDireccion" class="form-control1" placeholder="Ingrese Calle" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="number" name="numeracionDireccion" class="form-control1" placeholder="Ingrese Numeración" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="localidadDireccion" class="form-control1" placeholder="Ingrese Localidad" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="ciudadDireccion" class="form-control1" placeholder="Ingrese Ciudad" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="paisDireccion" class="form-control1" placeholder="Ingrese País" required/>
                            </div><br/>
                            <div class="form-group">
                                <select name="tipoDireccion" required>
                                    <option value="">Ingrese Tipo</option>
                                    <option value="Particular">Particular</option>
                                    <option value="Trabajo">Trabajo</option>
                                </select>
                            </div><br/>
                            <div class="form-group">
                                <select name="usuarioDireccion" required>
                                    <option value="">Ingrese Usuario</option>
                                    <?php 
                                        $url = "http://localhost:8080/usuario";
                                        $metodo = "GET";
                                        $respuesta = hacerPeticionHTTPUsuario($url, $metodo, null);
                                        $datos = json_decode($respuesta, true);
                                        for ($i = 0; $i < count($datos); $i ++) {
                                            echo "<option value='".$datos[$i]['id']."'># ".$datos[$i]['id']." ".$datos[$i]['nombre']." ".$datos[$i]['apellido']."</option>";
                                        }
                                    ?>  
                                </select>
                            </div><br/>
                            <div class="form-group">
                                <button type="submit" name="saveDireccion" class="btn btn-success btn-block">GUARDAR DIRECCION&nbsp;<i class="far fa-save"></i></button>   
                            </div>
                        </form>
                    </div>
                </div>      
                <div class="col-md-8">
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                        <th>#</th><th>Calle</th><th>Número</th><th>Localidad</th><th>Ciudad</th><th>País</th><th>Tipo</th><th>Usuario</th><th style="width: 12px">Acción</th>
                        </thead>
                        <tbody><?php
                                if (isset($_POST['getDirecciones'])) {
                                    for ($i = 0; $i < count($datos2); $i ++) {
                                        echo "<tr><td>".$datos2[$i]['id']."</td><td>".$datos2[$i]['calle']."</td><td>".$datos2[$i]['numero']."</td><td>".$datos2[$i]['localidad']."</td><td>".$datos2[$i]['ciudad']."</td><td>".$datos2[$i]['pais']."</td><td>".$datos2[$i]['tipo']."</td><td>".$datos2[$i]['usuario']['id']."</td>"
                                            ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos2[$i]['id']."'/></td></form>"
                                            . "</tr>";
                                    } 
                                }
                                if (isset($_POST['getDireccionPorId'])) {
                                    if($datos2 == NULL) {
                                        echo "<tr><td colspan='9'>No se encontró la dirección con id: ".$_POST['idDireccion']."</td></tr>";
                                    } else {
                                        echo "<tr><td>".$datos2['id']."</td><td>".$datos2['calle']."</td><td>".$datos2['numero']."</td><td>".$datos2['localidad']."</td><td>".$datos2['ciudad']."</td><td>".$datos2['pais']."</td><td>".$datos2['tipo']."</td><td>".$datos2['usuario']['id']."</td>"   
                                            ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos2['id']."'/></td></form>"
                                            . "</tr>";
                                    }
                                } 
                                if (isset($_POST['getDireccionesPorIdUsuario'])) {
                                    if($datos2 == NULL) {
                                        echo "<tr><td colspan='9'>No se encontraron direcciones del Usuario con id: ".$_POST['idOculto']."</td></tr>";
                                    } else {
                                        for ($i = 0; $i < count($datos2); $i ++) {
                                            echo "<tr><td>".$datos2[$i]['id']."</td><td>".$datos2[$i]['calle']."</td><td>".$datos2[$i]['numero']."</td><td>".$datos2[$i]['localidad']."</td><td>".$datos2[$i]['ciudad']."</td><td>".$datos2[$i]['pais']."</td><td>".$datos2[$i]['tipo']."</td><td>".$datos2[$i]['usuario']['id']."</td>"
                                                ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                                ."<input type='hidden' name='idOculto' value='".$datos2[$i]['id']."'/></td></form>"
                                                ."</tr>";
                                        }
                                    }
                                }
                                if (isset($_POST['getDireccionesPorTipo'])) {
                                    if($datos2 == NULL) {
                                        echo "<tr><td colspan='9'>No se encontraron direcciones de tipo: ".$_POST['typeDireccion']."</td></tr>";
                                    } else {
                                        for ($i = 0; $i < count($datos2); $i ++) {
                                            echo "<tr><td>".$datos2[$i]['id']."</td><td>".$datos2[$i]['calle']."</td><td>".$datos2[$i]['numero']."</td><td>".$datos2[$i]['localidad']."</td><td>".$datos2[$i]['ciudad']."</td><td>".$datos2[$i]['pais']."</td><td>".$datos2[$i]['tipo']."</td><td>".$datos2[$i]['usuario']['id']."</td>"
                                                ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                                ."<input type='hidden' name='idOculto' value='".$datos2[$i]['id']."'/></td></form>"
                                                ."</tr>";
                                        }
                                    }
                                }
                                if (isset($_POST['saveDireccion'])) {
                                    echo "<tr><td>".$datos2['id']."</td><td>".$datos2['calle']."</td><td>".$datos2['numero']."</td><td>".$datos2['localidad']."</td><td>".$datos2['ciudad']."</td><td>".$datos2['pais']."</td><td>".$datos2['tipo']."</td><td>".$datos2['usuario']['id']."</td>"   
                                        ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos2['id']."'/></td></form>"
                                        ."</tr>";
                                }
                                if (isset($_POST['updateDireccion'])) {
                                    echo "<tr><td>".$datos2['id']."</td><td>".$datos2['calle']."</td><td>".$datos2['numero']."</td><td>".$datos2['localidad']."</td><td>".$datos2['ciudad']."</td><td>".$datos2['pais']."</td><td>".$datos2['tipo']."</td><td>".$datos2['usuario']['id']."</td>"   
                                        ."<td><form action='' method='POST'><button type='submit' name='deleteDireccionPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos2['id']."'/></td></form>"
                                        ."</tr>";
                                }
                                if (isset($_POST['deleteDireccionPorId'])) {
                                    echo "<tr><td colspan='9'>".$respuesta2."</td></tr>";
                                }
                        ?></tbody>        
                    </div> 
                </div>
            </div>  
        </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7b950a26f0.js" crossorigin="anonymous"></script>
    <script>
        function confirmar() {
            if (!(confirm('¿Quieres borrar este registro?'))) { return false; }
        }
    </script>
    </body>
</html>

