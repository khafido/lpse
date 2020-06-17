<body id="page-top">
	<div id="wrapper">

		<?php $this->load->view("admin/includes/sidebar.php") ?>

		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/includes/breadcrumb.php") ?>

				<div class="card mb-6">
			<section class="p-t-20">
				<div class="">
					<div class="row">
						<div class="col-md-12">
							<div class="table-data__tool col-md-6">
								<div class="table-data__tool-left">
									<h3 class="title-5 m-b-35">data categories</h3>
								</div>
								<div class="table-data__tool-right">
									<button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal" data-target="#form_modal" id="add">
										<span class="fa fa-plus"></span> Add New</a>
									</button>
								</div>
							</div>
							<div class="just-padding" style="">
								<div class="list-group card col-md-4" style="padding:10px;" id="show_data">

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<form id="main_form">
				<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Data Category</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Category Name</label>
									<div class="col-md-8">
										<input type="text" name="name" id="name" class="form-control" placeholder="Category Name" required />
										<?php echo form_error('name'); ?>
									</div>
								</div>
								<div class="form-group row" id="parent_group">
									<label class="col-md-4 col-form-label">Main Category</label>
									<div class="col-md-8">
										<select name="parent" id="parent" class="form-control">

										</select>
									</div>
								</div>
								<div class="form-group row" id="sub_group">
									<label class="col-md-4   col-form-label">Sub Category</label>
									<div class="col-md-8">
										<select name="sub" id="sub" class="sub form-control">
											<option value="0"></option>
										</select>
									</div>
								</div>
							</div>
							<input type="hidden" name="kategori_id" id="kategori_id" class="form-control">
							<input type="hidden" name="kategori_parentid" id="kategori_parentid" class="form-control">
							<input type="hidden" name="id_sub" id="id_sub" class="form-control">
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								<input type="submit" id="btn_save" class="btn btn-success" value="Save" />
							</div>
						</div>
					</div>
				</div>
			</form>

			<!--MODAL DELETE-->
			<form>
				<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<strong>Are you sure to delete this record?</strong>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								<button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
							</div>
						</div>
					</div>
				</div>
			</form>


			<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title label label-danger" id="exampleModalLabel"><i class="fas fa-error_outline"></i> Info!</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<strong>Data Sudah Ada!</strong>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
        </div>
			</div>
			<!-- /.container-fluid -->
			<!-- Sticky Footer -->
			<?php $this->load->view("admin/includes/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>

</body>
	<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/includes/modal.php") ?>
	<?//php $this->load->view("admin/includes/js.php") ?>

	<script type="text/javascript">
		$(document).ready(function() {
			jQuery.validator.addMethod("noSpace", function(value, element) {
				return $.trim($("#name").val()).length != 0;
			}, "<span class='danger_label'>No space please and don't leave it empty</span>");

			var url = "<?php echo site_url('admin/kategori2/saveData')?>";
			show_category();

			$('#add').on('click', function() {
				window.url = "<?php echo site_url('admin/kategori2/saveData')?>";
				$('#parent').prop('disabled', false);
				$('#sub').prop('disabled', false);
				$('#name').val("");
			});

			$('#main_form').validate({
				rules: {
					name: {
						required: true,
						noSpace: true
					}
				},
				messages: {
					name: {
						required: "<span class='danger_label'>Please input Category Name!</span>",
					}
				},
				submitHandler: function(form) {
					simpan();
				}
			});

			function show_category() {
				$.ajax({
					type: 'GET',
					url: '<?php echo site_url('admin/kategori2/readData')?>',
					async: false,
					dataType: 'json',
					success: function(data) {
						var html = '';
						var main = '<option value="0"></option>';
						var i, j, k;
						for (i = 0; i < data.length; i++) {
							if (data[i].kategori_parentid == 0) {
								html += '<div class="col-md-12" style="padding-left:10px;">' +
									'<a href="#item-' + i + '" style="margin:10px 0px 0px 0px;" class="list" data-toggle="collapse">' +
									'<i class="fas fa-angle-right"></i> ' + data[i].kategori_nama +
									'</a>' +
									'<a href="#" style="padding-left:10px;" class="btn btn-danger pull-right btn-sm item_delete zmdi zmdi-delete" data-toggle="tooltip" data-placement="right" title="Remove" data-id="' + data[i].kategori_id + '" data-parent="' + data[i].kategori_parentid + '" data-sub="' + data[i].kategori_subparentid + '"> Hapus </a>' +
									'<a href="#" style="padding-left:10px;" class="btn btn-info pull-right btn-sm item_edit zmdi zmdi-edit" data-toggle="tooltip" data-placement="right" title="Edit"  data-id="' + data[i].kategori_id + '" data-parent="' + data[i].kategori_parentid + '" data-sub="' + data[i].kategori_subparentid + '" data-name="' + data[i].kategori_nama + '"> Ubah </a>' +
									'</div>';
							}
							html += '<div class="list-group collapse col-md-12" id="item-' + i + '">';
							for (j = 0; j < data.length; j++) {
								if (data[i].kategori_id == data[j].kategori_parentid && data[j].kategori_subparentid == 0) {
									html += '<div class="col-md-12" style="padding:10px 0px 0px 30px;">' +
										'<a style="" href="#item-' + i + '-' + j + '" class="list" data-toggle="collapse" style="">' +
										'<i class="fas fa-angle-right"></i> ' + data[j].kategori_nama +
										'</a>' +
										'<a href="#"  class="pull-right btn btn-danger btn-sm item_delete zmdi zmdi-delete" data-toggle="tooltip" data-placement="right" title="Remove"  data-id="' + data[j].kategori_id + '" data-parent="' + data[j].kategori_parentid + '" data-sub="' + data[j].kategori_subparentid + '"> Hapus </a>' +
										'<a href="#"  class="pull-right btn btn-info btn-sm item_edit zmdi zmdi-edit" data-toggle="tooltip" data-placement="right" title="Edit"  data-id="' + data[j].kategori_id +	'" data-parent="' + data[j].kategori_parentid + '" data-sub="' + data[j].kategori_subparentid + '" data-name="' + data[j].kategori_nama + '"> Ubah </a>' +
										'</div>' +
										'<div class="list-group collapse" id="item-' + i + '-' + j + '"><div class="col-md-12"></div>';
									for (k = 0; k < data.length; k++) {
										if (data[j].kategori_id == data[k].kategori_subparentid) {
											html += '<div class="col-md-12" style="padding:5px 0px 0px 30px;">' +
												'<a href="#" class="list" ><li>' + data[k].kategori_nama + '</li></a>' +
												'<a href="#"  class="pull-right btn btn-danger btn-sm item_delete zmdi zmdi-delete" data-toggle="tooltip" data-placement="right" title="Remove"  data-id="' + data[k].kategori_id + '" data-parent="' + data[k].kategori_parentid + '" data-sub="' + data[k].kategori_subparentid + '"> Hapus </a>' +
												'<a href="#"  class="pull-right btn btn-info btn-sm item_edit zmdi zmdi-edit" data-toggle="tooltip" data-placement="right" title="Edit"  data-id="' + data[k].kategori_id + '" data-parent="' + data[k].kategori_parentid + '" data-sub="' + data[k].kategori_subparentid + '" data-name="' + data[k].kategori_nama + '"> Ubah </a>' +
												'</div>';
										}
									}
									html += '</div>';
								}
							}
							html += '</div>';

							if (data[i].kategori_parentid == "0") {
								main += '<option value="' + data[i].kategori_id + '">' + data[i].kategori_nama + '</option>';
							}
						}
						$('#show_data').html(html);
						$('#parent').html(main);
					}
				});
			}

			function simpan() {
				// $('#btn_save').on('click',function(e){
				var kategori_nama = $('#name').val();
				var kategori_parentid = $('#parent').val();
				var id_sub = $('#sub').val();
				var kategori_id = $('#kategori_id').val()

				$.ajax({
					type: "POST",
					url: window.url,
					dataType: "JSON",
					data: {
						kategori_id: kategori_id,
						kategori_nama: kategori_nama,
						kategori_parentid: kategori_parentid,
						id_sub: id_sub
					},
					success: function(data) {
						$('[name="name"]').val("");
						$('[name="parent"]').val(0);
						$('[name="sub"]').val(0);
						$('#form_modal').modal('hide');
						show_category();
					},
					error: function(data) {
						console.log(data.responseText);
					}
				});
				return false;
				// });
			}

			$('#show_data').on('click', '.item_edit', function() {
				var name = $(this).data('name');
				var id = $(this).data('id');
				var parent = $(this).data('parent');
				var sub = $(this).data('sub');
				window.url = "<?php echo site_url('admin/kategori2/updateData')?>";

				$('[name="kategori_nama"]').val(name);
				$('[name="kategori_id"]').val(id);
				$('[name="kategori_parentid"]').val(parent);
				$('[name="id_sub"]').val(sub);

				$('#parent').val(parent);
				$('#parent').change();
				$('#sub').val(sub);

				if (parent != 0 && sub == 0) {
					$('#parent').prop('disabled', false);
					$('#sub').prop('disabled', true);
				} else if (parent == 0) {
					$('#parent').prop('disabled', true);
					$('#sub').prop('disabled', true);
				} else {
					$('#parent').prop('disabled', false);
					$('#sub').prop('disabled', false);
				}

				$('#form_modal').modal('show');
			});

			$('#show_data').on('click', '.item_delete', function() {
				var id = $(this).data('id');

				$('#modal_delete').modal('show');
				$('[name="kategori_id"]').val(id);
			});

			$('#btn_delete').on('click', function() {
				var kategori_id = $('#kategori_id').val();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('admin/kategori2/deleteData')?>",
					dataType: "JSON",
					data: {
						kategori_id: kategori_id
					},
					success: function(data) {
						$('#modal_delete').modal('hide');
						show_category();
					},
					error: function(data) {
						console.log(data.responseText);
					}
				});
				return false;
			});

			$('#parent').change(function show_sub() {
				var id = $(this).val();
				$.ajax({
					url: "<?php echo base_url();?>/admin/kategori2/getSubCategory",
					method: "POST",
					data: {
						id: id
					},
					async: false,
					dataType: 'json',
					success: function(data) {
						var html = '<option value="0"></option>';
						var i;
						for (i = 0; i < data.length; i++) {
							html += '<option value="' + data[i].kategori_id + '">' + data[i].kategori_nama + '</option>';
						}
						$('.sub').html(html);
					}
				});
			});
		});
	</script>

	<script>
		$(function() {
			$('.list').on('click', function() {
				$('.fas', this)
					.toggleClass('fas fa-angle-right')
					.toggleClass('fas fa-angle-down');
			});
		});
	</script>