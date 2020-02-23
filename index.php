<?php

?>


<HTML>

<HEAD>
<link rel="stylesheet" type="text/css" href="estilomep.css" />
</HEAD> 
<BODY>
<div id="contenedorf">

 <div id="frm">
<form action="ingresar.php" method="post" autocomplete="on">
  <p>
  <label>Usuario</label>
  <input name="username" type="text" placeholder="Tu login" id="txtbox">
  </p>
  <p>
  <label>Contrase&ntilde;a</label>
  <input name="password" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres" id="txtbox">
  </p>
  <p> 
        <input type="submit" name="login" value="Entrar" id="btn"/> 
  </p>
</form>
 </div>
</div>
</BODY> 

</HTML> 

