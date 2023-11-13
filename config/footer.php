<?php $num=1 ?>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>copyright &copy; 2020 <php? echo date("Y"); ?> - Desarrollado por
          <b><a href="https://indrijunanda.gitlab.io/" target="_blank">Del inge mejor del mundo</a></b>
          
          <?php if($num==0){ ?>
          <p>Administrador</p>
          <?php } else {?>
          <p>Secretaria</p>
          <?php }?>
        </span>
      </div>
    </div>
  </footer>