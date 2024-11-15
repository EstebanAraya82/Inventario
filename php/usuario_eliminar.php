<?php
	/* Almacenando datos */
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    /* Verificando usuario */
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");

	if($check_usuario->rowCount()==1){
    
     		
	    $eliminar_usuario=conexion();
	    $eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");

	    $eliminar_usuario->execute([":id"=>$user_id_del]);

	    if($eliminar_usuario->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡Usuario Eliminado!</strong><br>
		                El usuario se elimino con exito
		            </div>
		        ';
		   }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ups ocurrio un error inesperado!</strong><br>
		                No se puede eliminar el usuario, por favor intente nuevamente
		            </div>
		        ';
			}
		    
		    $eliminar_usuario=null;
			
		
		}else {
       			 echo '
          		  <div class="notification is-danger is-light">
              	  <strong>¡Ups ocurrio un error inesperado!</strong><br>
              	  El usuario que intenta eliminar no existe
           		 </div>
       		 ';
  			}
    $check_usuario=null;