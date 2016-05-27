    <?php
      if(!empty($scripts)){
        foreach ($scripts as $script) {
          echo '<script src="' . base_url() . 'static/js/' . $script . '.js"></script>';
        }
      }
    ?>
  </body>
</html>
