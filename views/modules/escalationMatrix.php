<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><h6 class="py-0">Escalation Matrix</h6></li>
  </ol>
</nav>





<div class="container card my-4 py-4 bg bg-light">


    <div id="matrixHeader"></div>
    

    <div class="card-body">

      <form class="px-4" id="matrixForm">
          <h3>Filtros</h3>
          <div class="form-row">
              <div class="form-group col-md-4 col-sm-12">
              <label for="">Seleccione Unidad</label>
                <select class="form-control" name="matrixUnidades" id="matrixUnidades">
                  <!-- JS Content -->
                </select>
              </div>
              <div class="form-group col-md-6 col-sm-12">
              <label for="">Seleccione Subunidad</label>
                <select class="form-control" name="matrixSubunidades" disabled id="matrixSubunidades">
                  <!-- JS Content -->
                </select>
              </div>
              <div class="form-group col-md-2 col-sm-12">
                <label for="">Fecha</label>
                <input class="form-control" name="matrixFecha" readonly id="matrixFecha">
              </div>
          </div>
          <br>
          <h3>Novedad</h3>

          <div class="form-row">
            <div class="form-group col-md-1 col-sm-12">
                <label for="">Id</label>
                <input type="text" class="form-control" name="matrixId" readonly id="matrixId">
              </div>
              <div class="form-group col-md-3 col-sm-12">
                <label for="">Kpi</label>
                <select class="form-control" name="matrixKpi" disabled id="matrixKpi">
                  <!-- JS Content -->
                </select>
              </div>
              <div class="form-group col-md-1 col-sm-12">
                <label for="">Meta</label>
                <input type="text" class="form-control" name="matrixMeta" readonly id="matrixMeta">
              </div>
              <div class="form-group col-md-1 col-sm-12">
                <label for="">Ejecutado</label>
                <input type="number" class="form-control" id="matrixResultado" name="matrixResultado" readonly>
              </div>
              
              
              <div class="form-group col-md-2 col-sm-12">
                <label for="">Alerta</label>
                <input class="form-control text-white bg" name="matrixAlerta" id="matrixAlerta" readonly>
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="">Responsable</label>
                <select class="form-control" name="matrixResponsable" id="matrixResponsable">
                  <option value="">Seleccionar...</option>
                  <option value="ANALISTA DE WORKFORCE">ANALISTA DE WORKFORCE</option> 
                  <option value="COORDINADOR DE OPERACIONES ">COORDINADOR DE OPERACIONES </option> 
                  <option value="COORDINADOR DE WORKFORCE  ">COORDINADOR DE WORKFORCE  </option> 
                  <option value="GERENTE DE OPERACIONES">GERENTE DE OPERACIONES</option> 
                  <option value="GERENTE DE WORKFORCE">GERENTE DE WORKFORCE</option> 
                  <option value="LIDER DE CALIDAD">LIDER DE CALIDAD</option> 
                  <option value="LIDER DE FORMACION">LIDER DE FORMACION</option> 
                  <option value="SUPERVISOR DE CALIDAD">SUPERVISOR DE CALIDAD</option> 
                  <option value="SUPERVISOR DE FORMACIÓN  ">SUPERVISOR DE FORMACIÓN  </option> 
                  <option value="SUPERVISOR DE OPERACIONES">SUPERVISOR DE OPERACIONES</option> 
                  <option value="SUPERVISOR DE WORKFORCE">SUPERVISOR DE WORKFORCE</option> 
                </select>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="">Principales Afectaciones</label>
                <textarea class="form-control" name="matrixAfectaciones" id="matrixAfectaciones" rows="5"></textarea>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="">Causas Principales</label>
                <textarea class="form-control" name="matrixCausas" id="matrixCausas" rows="5"></textarea>
              </div>
          </div>
          <h3>Acciones</h3>
          <div class="form-row">
              <div class="form-group col-md-12 col-sm-12">
                <label for="">Accion</label>
                <textarea class="form-control" name="matrixAcciones" id="matrixAcciones" rows="5"></textarea>
              </div>
          </div>

          <button type="submit" class="btn btn-info" id="matrixEnviar"><i data-feather="send"></i> Enviar</button>
      </form>
    </div>
</div>
<br>
