//get all data User
const get_data_all = () =>
	new Promise((resolve, reject) => {
		$.ajax({
			url: `${BASE_URL}User/getAllData`,
			type: "get",
			dataType: "json",
			success: (res) => resolve(res),
		});
	});

//get data platform by id platform
const getById = (id) =>
	new Promise((resolve, reject) => {
		$.ajax({
			url: `${BASE_URL}User/getDataById`,
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

	const elementUser = {
		name: 'input[name="name"]',
		email: 'input[name="email"]',
		phone: 'input[name="number"]',
		username: 'input[name="username"]',
		password: 'input[name="password"]',
	};

	const emptyUser = function () {
		$(elementUser.name).val("");
		$(elementUser.email).val("");
		$(elementUser.phone).val("");
		$(elementUser.username).val("");
		$(elementUser.password).val("");
		$("select[name='status']").val("");
	};

	const validateFormUser = function () {
		if ($(elementUser.name).val().lenght == 0) {
			swal_alert("Name form cannot be empty");
			return false;
		}
		if ($(elementUser.email).val().lenght == 0) {
			swal_alert("Email form cannot be empty");
			return false;
		}
		if ($(elementUser.phone).val().lenght == 0) {
			swal_alert("Phone form cannot be empty");
			return false;
		}
		if ($(elementUser.username).val().lenght == 0) {
			swal_alert("Username form cannot be empty");
			return false;
		}
		if ($(elementUser.password).val().lenght == 0) {
			swal_alert("Password form cannot be empty");
			return false;
		}
	};

	//get all data User every document is ready
	const get_data = function () {
		$.ajax({
			url: `${BASE_URL}User/getAllData`,
			type: "get",
			dataType: "json",
			success: function (res) {
				console.log(res);
				var row = "";
				$("#UserTB").DataTable().clear().destroy();
				$.each(res, function (i) {
					row += "<tr><td>" + res[i].name + "</td>";
					row += "<td>" + res[i].username + "</td>";
					row += "<td>" + res[i].phone + "</td>";
					row += "<td>" + res[i].email + "</td>";
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
						"' class='btn btn-danger btn_delete' style='margin-left:4px;''><i class='fa fa-fw fa-times-circle'></i></a></td>";
				});
				$("#UserTB tbody").html(row);
				$("#UserTB").DataTable();
			},
		});
	};

	//edit data user
	$(document).on("click", ".btn_edit", function (e) {
		e.preventDefault();

		getById({ id: this.id }).then((res) => {
			setDataEdit(res);
		});
	});

	$(document).on("click", ".btn_delete", function (e) {
		e.preventDefault();
		$.ajax({
			url: `${BASE_URL}User/deleteDataUser`,
			type: "post",
			data: { id: this.id },
			dataType: "json",
			success: function (res) {
				if (res.code === 1) {
					$("#overlay").fadeOut(400);
					swal_alert(res.pesan);
				} else {
					$("#overlay").fadeOut(400);
					swal_error(res.message);
				}
				emptyUser();
				get_data();
			},
		});
	});

	//set form edit data user
	const setDataEdit = function (data) {
		$("#modal-user").modal("show");
		$("#update_user").show();
		$("#save_user").hide();
		$("div.statusUser").show();
		$(elementUser.password).required = false;
		$(elementUser.name).val(data.name);
		$(elementUser.username).val(data.username);
		$(elementUser.email).val(data.email);
		$(elementUser.phone).val(data.phone);
		$(elementUser.password).attr(
			"placeholder",
			"Leave it blank if you don't change password!"
		);
		$("select[name='status']").val(data.is_deleted).trigger("change");
		$("input[name='id']").val(data.id);
	};

	//set form add new data user
	$("#addData").on("click", function () {
		$("div.statusUser").hide();
		$("#update_user").hide();
		$("#save_user").show();
		$(elementUser.password).required = true;
		emptyUser();
	});

	//update data
	$("#update_user").on("click", function (e) {
		e.preventDefault();
		$.ajax({
			url: `${BASE_URL}User/updateData`,
			type: "post",
			data: {
				name: $(elementUser.name).val(),
				phone: $(elementUser.phone).val(),
				email: $(elementUser.email).val(),
				username: $(elementUser.username).val(),
				password: $(elementUser.password).val(),
				status: $("select[name='status']").val(),
				id: $("input[name='id']").val(),
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
				emptyUser();
				get_data();
				$("#modal-user").modal("hide");
			},
		});
	});

	//submit new data
	$("form#userForm").on("submit", function (e) {
		e.preventDefault();
		$.ajax({
			url: `${BASE_URL}User/storeData`,
			type: "post",
			data: {
				name: $(elementUser.name).val(),
				phone: $(elementUser.phone).val(),
				email: $(elementUser.email).val(),
				username: $(elementUser.username).val(),
				password: $(elementUser.password).val(),
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
				emptyUser();
				get_data();
				$("#modal-user").modal("hide");
			},
		});
	});

	get_data();
});
