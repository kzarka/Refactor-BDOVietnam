<!-- End Modal Notification -->
<div class="modal fade" id="_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-success" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Xóa?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Bạn có muốn xóa bản ghi này?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
	          	<button class="btn btn-primary" type="button">Có, xóa</button>
	        </div>
      	</div>
    </div>
</div>
<!-- End Modal Notification -->

<!-- Modal Error -->
<div class="modal form fade" id="error_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Error!</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <p>System error!</p>
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
          </div>
        </div>
    </div>
</div>
<!-- End Modal Error -->

@stack('modals')
<footer class="app-footer">
    <div>
        <a href="{{ url('') }}">BDOVietnam</a>
        <span>&copy; 2018 Red Haired Xuan.</span>
    </div>
</footer>
