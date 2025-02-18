<section id="main-content">
    <section class="wrapper">
        <table id="example" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Nombre de usuario</th>
                    <th>Curso</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($alumnos as $value) {
                    ?>
                    <tr id="rowalumno<?php echo $value->id ?>">
                        <td>
                            <?php echo $value->nombre ?>
                        </td>
                        <td>
                            <?php echo $value->apellidos ?>
                        </td>
                        <td>
                            <?php echo $value->username ?>
                        </td>
                        <td>
                            <?php echo $value->curso ?>
                        </td>
                        <td><i class="eliminar fa fa-trash-o" style="cursor: pointer;"
                                id="alumno-<?php echo $value->id ?>"></i></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</section>

<script type="text/javascript">

    $(".eliminar").on("click", function () {
        let idalumno = this.id
        let res = idalumno.split("-")
        let id = res[1]

        $.post("<?php echo base_url(); ?>DashBoard/eliminarAlumno", { idalumno: id })
            .done(function (data) {
                $("#rowalumno"+id).fadeOut()
            })
    })

</script>

<script>
    $(function () {
        $('#example').DataTable({
            columsDefs: [{
                targets: [0],

                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 1]
            }]
        });
    });
</script>