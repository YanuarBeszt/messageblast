var url = window.location.pathname.split("/");
var idEmail = url.pop();

$(document).ready(function () {
	function swal_alert(data) {
		Swal.fire({
			title: "Success",
			text: data,
			type: "success",
		});
	}

	$('[data-toggle="tooltip"]').tooltip();

	$(".sendEmail").attr("disabled", true);
	$("#password").keyup(function () {
		if ($(this).val().length != 0) {
			$(".sendEmail").attr("disabled", false);
		} else {
			$(".sendEmail").attr("disabled", true);
		}
	});

	$(document).on("change", ".checkbox", function () {
		// console.log($(this).val());
		if (this.checked) {
			$.ajax({
				url: `${BASE_URL}Group/getDataByIdGroup `,
				type: "post",
				data: { id: $(this).val() },
				dataType: "json",
				success: function (res) {
					var total = Object.keys(res).length;
					var result = "";
					$.each(res, function (i) {
						result += res[i].email + ", ";
						// if (i != total - 1) {
						// 	result += ", ";
						// }
					});
					var textArea = $("textarea[name='emailto']");
					textArea.val(textArea.val() + result);
				},
			});
		}
	});

	//send email
	function sendMail(email, subject, message, password) {
		$.ajax({
			url: `${BASE_URL}Email/send_email`,
			type: "post",
			data: {
				email: email,
				subject: subject,
				message: message,
				password: password,
			},
			dataType: "json",
			success: function (res) {
				// console.log(res);
				// return;
				if (res.code === 1) {
					toastr.success(res.pesan);
				} else {
					toastr.error(res.pesan);
				}
			},
		});
	}

	$(".sendEmail").on("click", function () {
		// e.preventDefault();
		var email = $("textarea[name=emailto]").val().split(", ").filter(Boolean);
		var subject = $("input[name=emailsubject]").val();
		var password = $("input[name=password]").val();
		var message = CKEDITOR.instances.emailmessage.getData();

		setTimeout(function () {
			window.location.replace(`${BASE_URL}Email/draft`);
		}, 2000);
		swal_alert("Please wait, the message is being sent.");

		$.each(email, function (i) {
			sendMail(email[i], subject, message, password);
			console.log(email[i]);
		});
	});

	//get all data by id for set data to form
	const get_subject = function () {
		$.ajax({
			url: `${BASE_URL}Email/getDataById`,
			type: "post",
			data: { id: idEmail },
			dataType: "json",
			success: function (res) {
				$("input[name='emailsubject']").val(res.subject);
				// console.log(res);
				var editor = CKEDITOR.replace("emailmessage", {});
				editor.on("instanceReady", function (event) {
					editor.setData(res.message);
				});
			},
		});
	};

	get_subject();

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
					$("#Group").DataTable().clear().destroy();
					$.each(res, function (i) {
						row += "<tr><td><div class='callout callout-info'>";
						row += "<div class='custom-control custom-checkbox'>";
						row +=
							"<input class='custom-control-input checkbox' type='checkbox' id='" +
							res[i].id +
							"' value='" +
							res[i].id +
							"' data-toggle='tooltip' data-placement='top' title='Clik to add email contact'>";
						row +=
							"<label for='" +
							res[i].id +
							"' class='custom-control-label'>" +
							res[i].name +
							"</label>";
						row +=
							"<p style='font-size:10pt;color:grey;'>Created : " +
							res[i].created_date +
							"</p>";
						row += "</div></div>";
					});
				} else {
					row += "<div class='callout callout-info'>";
					row += "<span style='color:grey;'>No data Group !</span>";
					row += "</div>";
				}
				$('[data-toggle="tooltip"]').tooltip();

				$("#BodyGroupTB").html(row);
				$("#Group").DataTable({
					processing: false,
					paging: false,
					dom: "ftip",
				});
			},
		});
	};

	get_data();
});
