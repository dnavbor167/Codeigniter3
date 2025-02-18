<section id="main-content">
    <section class="wrapper">
    <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Crear Tareas</h4>
            <form action="" method="post" class="form-horizontal style-form" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Nombre de la tarea</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nombre">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="descripcion">
                   </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Fecha de finalización</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control round-form" name="fecha">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Archivos adjuntos</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" name="archivo">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Curso</label>
                <div class="col-sm-10">
                  <select name="curso">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-theme">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</section>