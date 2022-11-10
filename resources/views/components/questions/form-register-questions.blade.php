<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrar Pregunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="quickForm" method="post">
        <div class="modal-body">
          
          <div class="form-group">
            <label for="message-text" class="col-form-label">Seleccione la categoría de la pregunta:</label>
            <select class="form-control" name="category" id="">
              <option value="urgente">Urgente</option>
              <option value="reacciona">Reacciona</option>
              <option value="alerta">Alerta</option>
            </select>
          </div>

            <div class="form-group">
              <label for="message-text" class="col-form-label">Registre la pregunta:</label>
              <textarea class="form-control" name="ask" rows="3" maxlength="499" id=""></textarea>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
