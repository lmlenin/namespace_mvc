
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="title_modal">modal title</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table class="table table-responsive table-bordered" id="tbl_filtro" width="100%">
        <thead>
          <tr>
            <th>Filtros</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="dialog-btn-aplicar">Aplicar cambios</button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    
    $("#dialog-btn-aplicar").click(function(e){
      e.preventDefault();
      window.location.reload();
    });
  });

</script>