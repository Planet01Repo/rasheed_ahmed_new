<div class="modal_display">
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content my-modal-controls">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel" class="semi-bold mymodal-title">Detail</h4>
          </div>
          <div class="modal-body mymodal-body" id="myModalDescription">
            <h5 class="bold">Not Found.</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#example3, #example5").on("click", ".detailModalBtn", function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var path = $(this).data('path');
        $.ajax({
            url : path,
            type : 'get',
            dataType:'json',
            error: function(jqXHR, textStatus, errorThrown){
                error("Request not completed.Please try Again");
            },
            success: function(data){
                if (data['error'] !== undefined){
                    error(data['error']);
                }
                if (data['success'] !== undefined){
                    success(data['success']);
                    $('.mymodal-title').html(data.title);
                    $('.mymodal-body').html(detail_template(data.rows));
                    $('#defaultModal').modal('show');
                }
                if (data['redirect'] !== undefined){
                    setTimeout(function(){
                        window.location = data['redirect'];
                    },1500);
                }
            }
        });
    });
});
</script>