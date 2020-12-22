var selectedIds = [];
$(document).ready(function () {
	$("#contactGroupTB").DataTable({
		paging: false,
		processing: true,
		lengthMenu: [
			[10, 20, 30],
			[10, 20, 30],
		],
	});
	//init swal success
	function swal_alert(data) {
		Swal.fire({
			title: "Success",
			text: data,
			type: "success",
		});
	}

	//init swal error
	function swal_error(data) {
		Swal.fire({
			title: "Failed",
			text: data,
			type: "error",
		});
	}

	$("#modal-lg").on("hidden.bs.modal", function (e) {
		$("input[name='contactGroup']").attr("checked", false);
	});

	//get all data Group every document is ready
	const get_data = function () {
		$.ajax({
			url: `${BASE_URL}Group/getAllData`,
			type: "get",
			dataType: "json",
			success: function (res) {
				// console.log(res);
				var row = "";
				if (res != "") {
					$.each(res, function (i) {
						row += "<div class='callout callout-info'>";
						row += "<div class='row'>";
						row += "<div class='col-8 groupRow' id='" + res[i].id + "'>";
						row +=
							"<h5  data-toggle='tooltip' data-placement='top' title='Clik to show data Group'>" +
							res[i].name +
							"</h5>";
						row +=
							"<p style='font-size:10pt;color:grey;'>Created : " +
							res[i].created_date +
							"</p>";
						row += "</div>";
						row += "<div class='col-4'>";
						row +=
							"<a href='' class='btn editGroup' id='" +
							res[i].id +
							"' style='color: grey;'><i class='fa fa-edit'></i></a>";
						row +=
							"<a href='' class='btn deleteGroup' id='" +
							res[i].id +
							"' style='color: grey;'><i class='fa fa-trash'></i></a>";
						row += "</div>";
						row += "</div>";
						row += "</div>";
					});
				} else {
					row += "<div class='callout callout-info'>";
					row += "<span style='color:grey;'>No data Group !</span>";
					row += "</div>";
				}
				$('[data-toggle="tooltip"]').tooltip();

				$("#groupCol").html(row);
			},
		});
	};

	$(document).on("click", ".editGroup", function (e) {
		e.preventDefault();
		$("#modal-lg").modal("show");
		$("#submitGroup").hide();
		$("#updateGroup").show();
		$("input[name='contactGroup']").attr("checked", false);
		$.ajax({
			url: `${BASE_URL}Group/getDataByIdGroup`,
			type: "post",
			dataType: "json",
			data: {
				id: this.id,
			},
			success: function (res) {
				var ids = [];
				// console.log(ids);
				$("input[name='nameGroup']").val(res[0].groupname);
				$("input[name='groupId']").val(res[0].group_id);
				$.each(res, function (i) {
					$(`input[value='${res[i].contact_id}']`).attr("checked", true);
					ids.push(res[i].contact_id);
				});
				selectedIds = ids;
				// console.log(selectedIds);
			},
		});
	});

	$("input#contactGroup").on("change", function () {
		if (this.checked) {
			var id = $(this).val();
			selectedIds.push(id);
			console.log(selectedIds);
		} else {
			var id = $(this).val();
			const index = selectedIds.indexOf(id);
			if (index > -1) {
				selectedIds.splice(index, 1);
			}
			console.log(selectedIds);
		}
	});

	$(document).on("click", "#updateGroup", function (e) {
		e.preventDefault();
		$("#modal-lg").modal("show");
		$("#updateGroup").hide();
		$("#submitGroup").show();
		$("input[name='contactGroup']").attr("checked", false);
		var idGroup = $("input[name='groupId']").val();
		$.ajax({
			url: `${BASE_URL}Group/updateData`,
			type: "post",
			dataType: "json",
			data: {
				id: idGroup,
				name: $("input[name='nameGroup']").val(),
				selectedContact: selectedIds,
			},
			success: function (res) {
				if (res.code === 1) {
					setTimeout(function () {
						window.location.replace(`${BASE_URL}Contact`);
					}, 2000);
					$("#overlay").fadeOut(400);
					swal_alert(res.pesan);
				} else {
					$("#overlay").fadeOut(400);
					swal_error(res.pesan);
				}
				get_data();
			},
		});
	});

	$(document).on("click", ".deleteGroup", function (e) {
		e.preventDefault();
		var id = this.id;
		const config = {
			title: "Are you sure?",
			text: "You will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel please!",
		};
		sweetAlert.fire(config).then(deleting);
		function deleting(isConfirm) {
			if (isConfirm.value) {
				$.ajax({
					url: `${BASE_URL}Group/deleteData`,
					type: "post",
					data: { id: id },
					dataType: "json",
					success: function (res) {
						if (res.code === 1) {
							$("#overlay").fadeOut(400);
							swal_alert(res.pesan);
						} else {
							$("#overlay").fadeOut(400);
							swal_error(res.pesan);
						}
						get_data();
					},
				});
			} else {
				swal.fire("Cancelled", "Your data is safe :)", "success");
			}
		}
	});

	//submit new data
	$("#submitGroup").on("click", function (e) {
		e.preventDefault();
		$.ajax({
			url: `${BASE_URL}Group/storeData`,
			type: "post",
			data: {
				name: $("input[name='nameGroup']").val(),
				selectedContact: selectedIds,
			},
			dataType: "json",
			success: function (res) {
				setTimeout(function () {
					window.location.replace(`${BASE_URL}Contact`);
				}, 2000);
				if (res.code === 1) {
					$("#overlay").fadeOut(400);
					swal_alert(res.pesan);
				} else {
					$("#overlay").fadeOut(400);
					swal_error(res.pesan);
				}
				get_data();
				$("input[name='nameGroup']").val("");
				$("#modal-lg").modal("hide");
			},
		});
	});

	get_data();
});
