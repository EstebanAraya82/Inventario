<div class="main-container">

    <form class="box login" action="" method="POST" autocomplete="off">
		<h5 class="title is-5 has-text-centered is-uppercase">Login</h5>

		<div class="field">
			<label class="label">Usuario</label>
			<div class="control">
			    <input class="input is-success" type="text" name="login_usuario" placeholder="Ingrese usuario" pattern="[a-zA-Z0-9@.]{4,50}" maxlength="50" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label">Clave</label>
			<div class="control">
		  	 	<input class="input is-success" type="password" name="login_clave" placeholder="Ingrese clave" pattern="[a-zA-Z0-9$@.-*]{7,100}" maxlength="100" required >
				</div>
		</div>
		
		<label class="checkbox">
 		 <input type="checkbox">
		  Recuerdame
		</label>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-small is-info is-hovered">Iniciar sesion</button>
		</p>

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";

			}
		?>

	</form>

</div>