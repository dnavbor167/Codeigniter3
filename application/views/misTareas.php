<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <?php
            foreach ($tareas as $value) {
                ?>
                <div class="col-md-4 tarea">
                    <div class="row">
                        <strong>
                            <?php echo $value->nombre ?>
                        </strong>
                    </div>
                    <div class="row">
                        <?php echo $value->descripcion ?>
                    </div>
                    <div class="row">
                        <?php echo date('d-m-Y', strtotime($value->fecha_final)) ?>
                    </div>
                    <div class="row">
                        <?php
                        if ($value->archivo != "no_imagen.jpg") {
                        ?>
                            <a href="<?php echo base_url() . "uploads/" . $value->archivo ?>" download>Descargar</a>
                        <?php
                        } else {
                            echo "Sin archivos";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</section>