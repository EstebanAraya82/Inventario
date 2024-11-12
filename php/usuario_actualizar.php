<?php
	/* require_once "../inc/inicio_de_sesion.php"; */

	require_once "main.php";

    /* Almacenamiento id */
    $id=limpiar_cadena($_POST['id_usuario']);

    /* Verificación usuario */
	$check_usuario=conexion();
	$check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE id_usuario='$id'");

    if($check_usuario->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_usuario->fetch();
    }
    $check_usuario=null;


    /* Almacenando datos del administrador */
    $usuario_admin=limpiar_cadena($_POST['usuario_administrador']);
    $clave_admin=limpiar_cadena($_POST['clave_administrador']);



    /* Verificando campos obligatorios del administrador */
    if($usuario_admin=="" || $clave_admin==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No ha llenado los campos que corresponden a su usuario o contraseña
            </div>
        ';
        exit();
    }

    /* Verificando integridad de los datos (admin) */
    if(verificar_datos("[a-zA-Z0-9@.]{4,100}",$usuario_admin)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Su usuario no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_admin)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Su clave no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /* Verificando el administrador en BD */
    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario_usuario,clave_usuario FROM usuario WHERE usuario_usuario='$usuario_admin' AND id_usuario='".$_SESSION['id']."'");
   
    if($check_admin->rowCount()==1){
    	$check_admin=$check_admin->fetch();

    	if($check_admin['usuario_usuario']!=$usuario_admin || !password_verify($clave_admin, $check_admin['clave_usuario'])){
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Usuario y contraseña de administrador incorrectos
	            </div>
	        ';
	        exit();
    	}

    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Usuario o contraseña de administrador incorrectos
            </div>
        ';
        exit();
    }
    $check_admin=null;


    /* Almacenando datos del usuario */
    $nombre=limpiar_cadena($_POST['nombre_usuario']);
    $apellido=limpiar_cadena($_POST['apellido_usuario']);
    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $clave_1=limpiar_cadena($_POST['clave_usuario_1']);
    $clave_2=limpiar_cadena($_POST['clave_usuario_2']);
    $estado=limpiar_cadena($_POST['estado_usuario_2']);
    $rol=limpiar_cadena($_POST['rol_usuario'])


    /* Verificando campos obligatorios del usuario */
    if($nombre=="" || $apellido=="" || $usuario==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos (usuario) */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El apellido no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9@.]{4,100}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El usuario no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Verificando usuario */
    if($usuario!=$datos['usuario_usuario']){
	    $check_usuario=conexion();
	    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
	    if($check_usuario->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El usuario ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_usuario=null;
    }


    /* Verificando claves */
    if($clave_1!="" || $clave_2!=""){
    	if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                Las claves no coinciden con el formato solicitado
	            </div>
	        ';
	        exit();
	    }else{
		    if($clave_1!=$clave_2){
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Lo sentimos,currio un error inesperado!</strong><br>
		                Las contrase oñas que ha ingresado no coinciden
		            </div>
		        ';
		        exit();
		    }else{
		        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
		    }
	    }
    }else{
    	$clave=$datos['clave_usuario'];
    }


    /* Actualizar datos */
    $actualizar_usuario=conexion();
    $actualizar_usuario=$actualizar_usuario->prepare("UPDATE usuario SET nombre_usuario=:nombre,apellido_usuario=:apellido,
    usuario_usuario=:usuario,clave_usuario=:clave WHERE id_usuario=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":usuario"=>$usuario,
        ":clave"=>$clave,
        ":id"=>$id
    ];

    if($actualizar_usuario->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario actualizado!</strong><br>
                El usuario se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_usuario=null;