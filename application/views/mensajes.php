<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <button id="btnMensaje" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal"> Enviar
                Mensaje </button>
        </div>

        <table id="example" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($mensajes as $value) {

                    $nombreapellidos = $this->Site_model->getNombre($value->id_from);
                    $nombre = $nombreapellidos[0]->nombre;
                    $apellidos = $nombreapellidos[0]->apellidos;
                    ?>
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo $apellidos ?></td>
                        <td><?php echo date('d-m-Y H:i',strtotime($value->created_at)) ?></td>
                        <td onclick="vermensaje(<?php echo $value->id ?>, '<?php echo $nombre . ' ' . $apellidos ?>')" style="cursor: pointer;">Ver </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Enviar Mensaje</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Destinatario</label><br>
                                <div class="col-sm-10">
                                    <select name="id_to">
                                        <option class="form-control" value="Selecciona un usuario" disabled>Selecciona un usuario</option>
                                        <?php
                                        foreach ($usuarios as $value) {
                                            echo "<option id='user-" . $value->id . "' value='" . $value->token_mensaje . "'>" . $value->nombre . " " . $value->apellidos . "</option>";
                                        }
                                        ?>
                                    </select><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Mensaje</label><br>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="mensaje" cols=6></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label"></label><br>
                                <div class="col-sm-10">
                                    <input class="form-control" type="submit" value="Enviar">
                                </div>
                            </div>
                        </form> <br>
                    </div>
                    <div class="modal-footer" style="margin-top: 25px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="modalmensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Mensaje de </h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer" style="margin-top: 25px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
    function vermensaje(id, nombre) {
        console.log(nombre)
        $.post("http://localhost/Codeigniter3/DashBoard/getMensaje", { idmensaje: id })
            .done(function(data) {
                $("#modalmensaje #myModalLabel").append(nombre);
                $("#modalmensaje .modal-body").html(data);
                $("#modalmensaje").modal('show');
            })
    }

    $(function () {
        $('#example').DataTable({
            columsDefs: [{
                targets: [0],

                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [2],
                orderData: [2, 1]
            }]
        });
    });
</script>