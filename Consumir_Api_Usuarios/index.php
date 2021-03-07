<?php include 'gestorUsuario.php';?>
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
                <a href="#" class="navbar-brand">SISTEMA DE USUARIOS - CONSUMIENDO API Rest</a>
            </div>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="direcciones.php">Ir a Direcciones</a>
            </li>
        </nav>
        <div class="container p-3">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="form-group">
                            <button type="submit" name="getUsuarios"class="btn btn-success btn-block">VER TODOS LOS USUARIOS&nbsp;<i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="number" name="idUsuario" id="button-addon1" class="form-control1" placeholder="Consultar por ID" required/>
                            <button type="submit" name="getUsuarioPorId" aria-describedby="button-addon1" class="btn btn-success btn-block"><i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="text" name="nameUsuario" id="button-addon2" class="form-control1" placeholder="Consultar por Nombre" required/>
                            <button type="submit" name="getUsuariosPorNombre" aria-describedby="button-addon2" class="btn btn-success btn-block"><i class="far fa-paper-plane"></i></button>
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
                                <input type="number" name="numeroUsuario" id="button-addon3" class="form-control1" placeholder="Ingrese ID" required/>
                                <button type="submit" name="updateUsuario" aria-describedby="button-addon3" class="btn btn-success btn-block"><i class="fas fa-pencil-alt"></i></button>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="nombreUsuario" class="form-control1" placeholder="Ingrese Nombre" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="text" name="apellidoUsuario" class="form-control1" placeholder="Ingrese Apellido" required/>
                            </div><br/>
                            <div class="form-group">
                                <input type="email" name="emailUsuario" class="form-control1" placeholder="Ingrese Email @" required/>
                            </div><br/>
                            <div class="form-group">
                                <button type="submit" name="saveUsuario" class="btn btn-success btn-block">GUARDAR USUARIO&nbsp;<i class="far fa-save"></i></button>   
                            </div>
                        </form>
                    </div>
                </div>      
                <div class="col-md-8">
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                        <th>#</th><th>Nombre</th><th>Apellido</th><th>Email</th><th style="width: 16px">Dirección</th><th style="width: 12px">Acción</th>
                        </thead>
                        <tbody><?php
                                if (isset($_POST['getUsuarios'])) {
                                    for ($i = 0; $i < count($datos); $i ++) {
                                        echo "<tr><td>".$datos[$i]['id']."</td><td>".$datos[$i]['nombre']."</td><td>".$datos[$i]['apellido']."</td><td>".$datos[$i]['email']."</td>"
                                            ."<td><form action='direcciones.php' method='POST'><button type='submit' name='getDireccionesPorIdUsuario' class='btn btn-success btn-block'><i class='far fa-address-card'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos[$i]['id']."'/></td></form>"
                                            ."<td><form action='' method='POST'><button type='submit' name='deleteUsuarioPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos[$i]['id']."'/></td></form>"
                                            ."</tr>";
                                    } 
                                }
                                if (isset($_POST['getUsuarioPorId'])) {
                                    if($datos == NULL) {
                                        echo "<tr><td colspan='6'>No se encontró el usuario con id: ".$_POST['idUsuario']."</td></tr>";
                                    } else {
                                        echo "<tr><td>".$datos['id']."</td><td>".$datos['nombre']."</td><td>".$datos['apellido']."</td><td>".$datos['email']."</td>"
                                            ."<td><form action='direcciones.php' method='POST'><button type='submit' name='getDireccionesPorIdUsuario' class='btn btn-success btn-block'><i class='far fa-address-card'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                            ."<td><form action='' method='POST'><button type='submit' name='deleteUsuarioPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                            ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                            ."</tr>";
                                    }
                                } 
                                if (isset($_POST['getUsuariosPorNombre'])) {
                                    if($datos == NULL) {
                                        echo "<tr><td colspan='6'>No se encontraron usuarios con nombre: ".$_POST['nameUsuario']."</td></tr>";
                                    } else {
                                        for ($i = 0; $i < count($datos); $i ++) {
                                            echo "<tr><td>".$datos[$i]['id']."</td><td>".$datos[$i]['nombre']."</td><td>".$datos[$i]['apellido']."</td><td>".$datos[$i]['email']."</td>"
                                                ."<td><form action='direcciones.php' method='POST'><button type='submit' name='getDireccionesPorIdUsuario' class='btn btn-success btn-block'><i class='far fa-address-card'></i></button>&nbsp;"
                                                ."<input type='hidden' name='idOculto' value='".$datos[$i]['id']."'/></td></form>"
                                                ."<td><form action='' method='POST'><button type='submit' name='deleteUsuarioPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                                ."<input type='hidden' name='idOculto' value='".$datos[$i]['id']."'/></td></form>"
                                                ."</tr>";
                                        }
                                    }
                                }
                                if (isset($_POST['saveUsuario'])) {
                                    echo "<tr><td>".$datos['id']."</td><td>".$datos['nombre']."</td><td>".$datos['apellido']."</td><td>".$datos['email']."</td>"
                                        ."<td><form action='direcciones.php' method='POST'><button type='submit' name='getDireccionesPorIdUsuario' class='btn btn-success btn-block'><i class='far fa-address-card'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                        ."<td><form action='' method='POST'><button type='submit' name='deleteUsuarioPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                        ."</tr>";
                                }
                                if (isset($_POST['updateUsuario'])) {
                                    echo "<tr><td>".$datos['id']."</td><td>".$datos['nombre']."</td><td>".$datos['apellido']."</td><td>".$datos['email']."</td>"
                                        ."<td><form action='direcciones.php' method='POST'><button type='submit' name='getDireccionesPorIdUsuario' class='btn btn-success btn-block'><i class='far fa-address-card'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                        ."<td><form action='' method='POST'><button type='submit' name='deleteUsuarioPorId' class='btn btn-danger btn-block' onclick='confirmar()'><i class='far fa-trash-alt'></i></button>&nbsp;"
                                        ."<input type='hidden' name='idOculto' value='".$datos['id']."'/></td></form>"
                                        ."</tr>";
                                }
                                if (isset($_POST['deleteUsuarioPorId'])) {
                                    echo "<tr><td colspan='6'>".$respuesta."</td></tr>";
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

