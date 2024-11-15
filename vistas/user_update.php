<?php

	require_once "./php/main.php";

    $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
    $id=limpiar_cadena($id);
?>
<div class="container is-fluid mb-6">
	<?php if($id==$_SESSION['id']){ ?>
		<h2 class="subtitle">Actualizar datos del usuario</h2>
	<?php }else{ ?>
		<h1 class="title">Usuarios</h1>
		<h2 class="subtitle">Actualizar usuario</h2>
	<?php } ?>
</div>

<div class="container pb-6 pt-6">
	<?php

		include "./inc/btn_atras.php";

        /* Verificando usuario */
    	$check_usuario=conexion();
    	$check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

        if($check_usuario->rowCount()>0){
        	$datos=$check_usuario->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required >
		
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="usuario_nombre" placeholder="Ingrese nombres" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required value="<?php echo $datos['usuario_nombre']; ?>">
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="usuario_apellido" placeholder="Ingrese apellidos" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required value="<?php echo $datos['usuario_apellido']; ?>">
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="usuario_usuario" placeholder="Ingrese usuario" pattern="[a-zA-Z0-9@.]{4,100}" maxlength="100" required value="<?php echo $datos['usuario_usuario']; ?>">
				</div>
		  	</div>
			
		  	<div class="column">
		    	<div class="control">
					<label>Estado</label>
				  	<input class="input" type="text" name="usuario_estado" placeholder="Ingrese estado" pattern="[a-zA-Z0-9@.]{4,20}" maxlength="20" required value="<?php echo $datos['usuario_estado']; ?>" >
				</div>
		  	</div>
              </div>
			  <br><br>
        <p class="has-text-centered">
            SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave deje los campos vacíos.
        </p>
        <br>
			<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
				  	<input class="input" type="password" name="usuario_clave_1" placeholder="ingrese clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>              
              <div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
					<input class="input" type="password" name="usuario_clave_2" placeholder="Repita clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
		      </div>
              </div>
              </div>
			  <div class="column">
			<label>Rol</label><br>
			<div class="select is-rounded">
				<select name="usuario_rol">
					<option value="" selected="" >Seleccione rol</option>					
					<?php
					    $roles=conexion();
						$roles=$roles->query("SELECT * From rol");
						if($roles->rowCount()>0){
							$roles=$roles->fetchAll();
							foreach($roles as $row){
								echo '<option value="'.$row['rol_id'].'" >'.$row['rol_nombre'].'</option>';

							}
						}
						$roles=null;
					?>
				</select>
			</div>
		</div>
		</div>             
		<br><br><br>
		<p class="has-text-centered">
			Para poder actualizar los datos de este usuario por favor ingrese su USUARIO y CLAVE con la que ha iniciado sesión
		</p>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="administrador_usuario" pattern="[a-zA-Z0-9@.]{4,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>clave</label>
				  	<input class="input" type="password" name="administrador_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/alerta_error.php";
		}
		$check_usuario=null;
	?>
</div>