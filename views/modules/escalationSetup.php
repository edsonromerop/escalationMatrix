<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><h6 class="py-0"> <i class="text-muted" data-feather="settings"></i> Escalation Matrix Setup </h6></li>
  </ol>
</nav>





<div class="container card my-4 py-4 bg bg-light">
    <div class="card-header bg bg-light">
        Setup KPI Escalation matrix
    </div>
    
    <div class="card-body">
        <form class="px-4" id="matrixSetup">
            <h3>Filtros</h3>
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
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
            </div>
        </form>


        <div class="px-4 mt-3">
        <h3>Niveles de Escalamiento</h3>
        </div>

        <div class="px-4 mt-3 d-flex" id="matrix_Mail">
            <div class="card col-md-4 col-sm-12 px-0 mr-1">
                <div class="card-header bg bg-light">
                    <div class="spinner-border spinner-border-sm text-info" role="status">
                        <span class="sr-only"></span>
                    </div>
                    Nivel 1
                    <i data-feather="edit" class="float-right text-muted mt-1 matrix_EditMail" nivel="1" alerta="mailAmarilla" data-toggle="modal" data-target="#matrix_modalMail"></i>
                </div>
                <ul class="list-group" id="matrix_mailAmarilla">
                </ul>
            </div>
            <div class="card col-md-4 col-sm-12 px-0 mr-1">
                <div class="card-header bg bg-light">
                <div class="spinner-border spinner-border-sm text-warning" role="status">
                        <span class="sr-only"></span>
                    </div>
                    Nivel 2
                    <i data-feather="edit" class="float-right text-muted mt-1 matrix_EditMail" nivel="2" alerta="mailNaranja" data-toggle="modal" data-target="#matrix_modalMail"></i>
                </div>
                <ul class="list-group" id="matrix_mailNaranja">
                </ul>
            </div>
            <div class="card col-md-4 col-sm-12 px-0 mr-1">
                <div class="card-header bg bg-light">
                <div class="spinner-border spinner-border-sm text-danger" role="status">
                        <span class="sr-only"></span>
                    </div>
                    Nivel 3
                    <i data-feather="edit" class="float-right text-muted mt-1 matrix_EditMail" nivel="3" alerta="mailRoja" data-toggle="modal" data-target="#matrix_modalMail"></i>
                </div>
                <ul class="list-group" id="matrix_mailRoja">
                </ul>
            </div>
        </div>



           <!-- Modal -->
        <div class="modal fade" id="matrix_modalMail" tabindex="-1" role="dialog" aria-labelledby="matrix_modalMailCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Direcciones de Correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="matrix_setupMail">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" data-dismiss="modal" id="matrix_updateMail"><i data-feather="save"></i> Guardar</button>
                </div>
                </div>
            </div>
        </div>


    
        <div class="px-4 mt-5" id="matrix_formSetup">
            <h3>Configuración de Rangos KPI</h3>
            <div id="matrix_KpiAsignados">
            </div>
        </div>


        

    </div>
</div>

