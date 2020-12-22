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

	$(document).on("change", ".checkbox", function () {
		// console.log($(this).val());
		if (this.checked) {
			$.ajax({
				url: `${BASE_URL}Group/getDataByIdGroup `,
				type: "post",
				data: { id: $(this).val() },
				dataType: "json",
				success: function (res) {
					var result = "";
					$.each(res, function (i) {
						result += res[i].phone + ", ";
					});
					var textArea = $("textarea[name='phoneto']");
					textArea.val(textArea.val() + result);
				},
			});
		}
	});

	//send whatsapp
	function sendWa(phone, message) {
		$.ajax({
			url: `${BASE_URL}Message/sendMessage`,
			type: "post",
			data: {
				phone: phone,
				message: message,
			},
			dataType: "json",
			success: function (res) {
				if (res.code === 1) {
					toastr.success(res.pesan);
				} else {
					toastr.error(res.pesan);
				}
			},
		});
	}

	$(".sendSms").on("click", function () {
		var phone = $("textarea[name=phoneto]").val().split(", ").filter(Boolean);
		var message = CKEDITOR.instances.phonemessage.document.getBody().getText();

		setTimeout(function () {
			window.location.replace(`${BASE_URL}Message/draft`);
		}, 2000);
		swal_alert("Please wait, the message is being sent.");

		$.each(phone, function (i) {
			sendWa(phone[i], message);
			console.log(phone[i]);
		});
	});

	//get all data by id for set data to form
	const get_subject = function () {
		$.ajax({
			url: `${BASE_URL}Message/getDataById`,
			type: "post",
			data: { id: idEmail },
			dataType: "json",
			success: function (res) {
				// console.log(res);
				var editor = CKEDITOR.replace("phonemessage", {
					htmlEncodeOutput: false,
					entities: false,
				});
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
