<div class="container is-fluid mb-6">
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Alta usuario</h2>
</div>
<div class="container pb-6 pt-6">
		<?php 
		include "./inc/btn_atras.php";
		require_once "./php/main.php"; 
		?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="usuario_nombre" placeholder="Ingrese nombres" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="usuario_apellido" placeholder="Ingrese apellidos" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="usuario_usuario" placeholder="Ingrese usuario" pattern="[a-zA-Z0-9@.]{4,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" name="usuario_clave_1" placeholder="Ingrese clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
              </div>
         <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
				  	<input class="input" type="password" name="usuario_clave_2" placeholder="Repita clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>              
              <div class="column">
		    	<div class="control">
					<label>Estado</label>
				  	<input class="input" type="text" name="usuario_estado" placeholder="Ingrese estado" pattern="[a-zA-Z0-9@.]{4,20}" maxlength="20" required >
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
        
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>
