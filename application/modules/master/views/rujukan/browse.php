<script type="text/javascript">
	$(document).ready(function () {
		
		var oTable = $('#rujukan').dataTable({
			"sPaginationType"	: "full_numbers",
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?php echo site_url('master/rujukan/load_data'); ?>",
			"aoColumnDefs"		: [
									  { "bSortable": false, "aTargets": [ 2 ] }
								  ],
			"aoColumns"			: [
									  { sWidth: '70%' },
									  { sWidth: '20%' },
									  { sWidth: '10%' }
								  ]
		});
		
		$('#rujukan').on('click', '.delete-row', function() {
			var id = $(this).attr('id');
			alertify.set({
				labels: {
					ok: "OK",
					cancel: "Batal"
				},
				delay: 5000,
				buttonReverse: false,
				buttonFocus: "ok"
			});
			alertify.confirm("Hapus record tersebut?", function (e) {
				if (e) {
					$.ajax({
						type: 'get',
						url: '<?php echo site_url('master/rujukan/delete'); ?>',
						data: 'id=' + id,
						success: function() {
							oTable.fnDraw();
							alertify.success("Record telah di hapus dari database!");
						},
						error: function() {
							alertify.error("Penghapusan record gagal!");
						}
					});
				}
			});
			return false;
		});
		
	});
</script>
<style type="text/css">
	.dashboard-wrapper .left-sidebar {
		margin-right: 0;
	}
	.form-actions {
		border-top: 0;
		border-bottom: 1px solid #E5E5E5;
		margin: 0;
		padding: 5px 10px 5px;
	}
	#rujukan_processing {
		position			: absolute;
		top					: 50%;
		left				: 50%;
		width				: 20em;
		height				: 2em;
		margin-top			: -10em; /*set to a negative number 1/2 of your height*/
		margin-left			: -10em; /*set to a negative number 1/2 of your width*/
		border				: 1px solid #ccc;
		background-color	: #f3f3f3;
		text-align			: center;
		padding-top			: 0.5em;
		padding-bottom		: 0.5em;
	}
</style>
<div class="left-sidebar">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget">
				<div class="widget-header">
					<div class="title">Rujukan</div>
					<span class="tools"><a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a></span>
				</div>
				<div class="form-actions no-margin">
					<a id="tambah" class="btn btn-info bottom-margin pull-right" href="<?php echo site_url('master/rujukan/add'); ?>" data-original-title="">Tambah</a>
					<div class="clearfix"></div>
				</div>
				<div class="widget-body">
					<div id="dt_example" class="example_alt_pagination">
						<table class="table table-striped table-condensed table-striped table-hover table-bordered pull-left" id="rujukan">
							<thead>
								<tr>
									<th>Nama Rujukan</th>
									<th>Jenis</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="3" class="dataTables_empty">Loading data from server</td>
								</tr>
							</tbody>
						</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
