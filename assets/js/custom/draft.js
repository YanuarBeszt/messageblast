var url = window.location.pathname.split("/");
var getPath = url[2];
if (getPath === "Email") {
	var idType = 1;
} else if (getPath === "Whatsapp") {
	var idType = 2;
} else {
	var idType = 3;
}
//get data platform by id platform
const getById = (id) =>
	new Promise((resolve, reject) => {
		$.ajax({
			url: `${BASE_URL}${getPath}/getDataById`,
			type: "post",
			data: id,
			dataType: "json",
			success: (res) => resolve(res),
		});
	});

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
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

	const elementEmail = {
		subject: 'input[name="subject"]',
		message: 'textarea[name="message"]',
		statusDraft: 'select[name="statusDraft"]',
	};
	// const elementWhatsapp = {
	// 	subject: 'input[name="subject"]',
	// 	message: 'textarea[name="message"]',
	// };
	// const elementMessage = {
	// 	subject: 'input[name="subject"]',
	// 	message: 'textarea[name="message"]',
	// };

	const emptyEmail = function () {
		$(elementEmail.subject).val("");
		CKEDITOR.instances.message.setData("");
		$("input[name='id']").val("");
		$("#update_draft").hide();
		$("#save_draft").show();
		$("#statusForm").hide();
	};

	$("#modal-draft").on("hidden.bs.modal", function (e) {
		emptyEmail();
	});
	//edit data contact
	$(document).on("click", ".btn_edit", function (e) {
		e.preventDefault();

		getById({ id: this.id }).then((res) => {
			setDataEdit(res);
			// console.log(res);
		});
	});

	//set form edit data user
	const setDataEdit = function (data) {
		$("#modal-draft").modal("show");
		$("#update_draft").show();
		$("#save_draft").hide();
		$("#statusForm").show();
		$(elementEmail.subject).val(data.subject);
		CKEDITOR.instances.message.setData(data.message);
		$('select[name="statusDraft"]').val(data.is_deleted).trigger("change");
		$("input[name='id']").val(data.id);
	};

	//edit data draft
	$("#update_draft").on("click", function (e) {
		e.preventDefault();
		var editorText = CKEDITOR.instances.message.getData();
		$.ajax({
			url: `${BASE_URL}${getPath}/action_update`,
			type: "post",
			data: {
				subject: $(elementEmail.subject).val(),
				message: editorText,
				id: $("input[name='id']").val(),
				statusDraft: $(elementEmail.statusDraft).val(),
			},
			dataType: "json",
			success: function (res) {
				if (res.code === 1) {
					$("#overlay").fadeOut(200);
					swal_alert(res.pesan, "success");
				} else {
					$("#overlay").fadeOut(200);
					swal_error(res.message);
				}
				emptyEmail();
				get_data();
				$("#modal-draft").modal("hide");
			},
		});
	});

	//submit new data
	$("form#draftForm").on("submit", function (e) {
		e.preventDefault();
		// var name = $(elementDraft.name).val();
		// var editor = $(elementEmail.message).CKEDITOR();
		var editorText = CKEDITOR.instances.message.getData();
		// console.log(editorText);
		// return;
		$.ajax({
			url: `${BASE_URL}${getPath}/storeData`,
			type: "post",
			data: {
				subject: $(elementEmail.subject).val(),
				message: editorText,
			},
			dataType: "json",
			success: function (res) {
				if (res.code === 1) {
					$("#overlay").fadeOut(400);
					swal_alert(res.pesan);
				} else {
					$("#overlay").fadeOut(400);
					swal_error(res.pesan);
				}
				emptyEmail();
				get_data();
				$("#modal-draft").modal("hide");
			},
		});
	});

	//delete data draft
	$(document).on("click", ".btn_delete", function (e) {
		e.preventDefault();
		var id = this.id;
		// console.log(this.id);
		// return;
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
					url: `${BASE_URL}${getPath}/action_delete`,
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (res) {
						console.log(res);
						if (res.code === 1) {
							$("#overlay").fadeOut(400);
							swal_alert(res.pesan, "success");
						} else {
							$("#overlay").fadeOut(400);
							swal_error(res.message);
						}
						emptyEmail();
						get_data();
					},
				});
			} else {
				swal.fire("Cancelled", "Your data is safe :)", "success");
			}
		}
	});

	//get all data Email every document is ready
	const get_data = function () {
		$.ajax({
			url: `${BASE_URL}${getPath}/getAllData`,
			type: "post",
			data: { type: idType },
			dataType: "json",
			success: function (res) {
				// console.log(res);
				var row = "";
				var no = 1;
				$("#draftTB").DataTable().clear().destroy();
				$.each(res, function (i) {
					row += "<tr><td>" + no + "</td>";
					row += "<td>" + res[i].subject + "</td>";
					row += "<td>" + res[i].created_date + "</td>";
					if (res[i].is_deleted == "n") {
						row +=
							"<td><a href='#' class='btn btn-success disabled'>Active</a></td>";
					} else {
						row +=
							"<td><a href='#' class='btn btn-danger disabled'>Non-Active</a></td>";
					}
					row +=
						"<td><a href='#' id='" +
						res[i].id +
						"' class='btn btn-warning btn_edit'><i class='fa fa-fw fa-edit'></i></a><a href='#' id='" +
						res[i].id +
						"' class='btn btn-danger btn_delete' style='margin-left:4px;''><i class='fa fa-fw fa-times-circle'></i></a><a href='" +
						`${BASE_URL}${getPath}/blast/` +
						res[i].id +
						"' class='btn btn-primary' style='margin-left:4px;''><i class='fas fa-mail-bulk' style='color:white;' data-toggle='tooltip' data-placement='top' title='Blast Email'></i></a></td>";
					no++;
				});
				$("#draftTB tbody").html(row);
				$("#draftTB").DataTable();
			},
		});
	};

	get_data();
});
