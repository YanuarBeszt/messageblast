//get data platform by id platform
const getById = (id) =>
  new Promise((resolve, reject) => {
    $.ajax({
      url: `${BASE_URL}Contact/getDataById`,
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

  const elementContact = {
    name: 'input[name="name"]',
    email: 'input[name="email"]',
    phone: 'input[name="number"]',
  };

  const emptyContact = function () {
    $(elementContact.name).val("");
    $(elementContact.email).val("");
    $(elementContact.phone).val("");
  };

  const validateFormContact = function () {
    if ($(elementContact.name).val().lenght == 0) {
      swal_alert("Name form cannot be empty");
      return false;
    }
    if ($(elementContact.email).val().lenght == 0) {
      swal_alert("Email form cannot be empty");
      return false;
    }
    if ($(elementContact.phone).val().lenght == 0) {
      swal_alert("Phone form cannot be empty");
      return false;
    }
  };

  //create group
  $("#save_group").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: `${BASE_URL}Contact/createGroup`,
      type: "post",
      dataType: "json",
      data: {
        groupName: $("input[name='groupName']").val(),
      },
    });
  });

  //edit data contact
  $(document).on("click", ".btn_edit", function (e) {
    e.preventDefault();

    getById({ id: this.id }).then((res) => {
      setDataEdit(res);
    });
  });

  //set form edit data user
  const setDataEdit = function (data) {
    $("#modal-contact").modal("show");
    $("#update_contact").show();
    $("#save_contact").hide();
    $(elementContact.name).val(data.name);
    $(elementContact.email).val(data.email);
    $(elementContact.phone).val(data.phone);
    $("input[name='id']").val(data.id);
  };

  $(document).on("click", "#update_contact", function (e) {
    e.preventDefault();
    $.ajax({
      url: `${BASE_URL}Contact/action_update`,
      type: "post",
      dataType: "json",
      data: {
        name: $(elementContact.name).val(),
        email: $(elementContact.email).val(),
        phone: $(elementContact.phone).val(),
        id: $("input[name='id']").val(),
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
        emptyContact();
        get_data();
        $("#modal-contact").modal("hide");
      },
    });
  });

  $(document).on("click", ".btn_delete", function (e) {
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
          url: `${BASE_URL}Contact/action_delete`,
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

  //get all data Contact every document is ready
  const get_data = function () {
    $.ajax({
      url: `${BASE_URL}Contact/getAllData`,
      type: "get",
      dataType: "json",
      success: function (res) {
        // console.log(res);
        var row = "";
        $("#ContactTB").DataTable().clear().destroy();
        $.each(res, function (i) {
          row += "<tr><td>" + res[i].name + "</td>";
          row += "<td>" + res[i].phone + "</td>";
          row += "<td>" + res[i].email + "</td>";
          row +=
            "<td><a href='#' id='" +
            res[i].id +
            "' class='btn btn-warning btn_edit'><i class='fa fa-fw fa-edit'></i></a><a href='#' id='" +
            res[i].id +
            "' class='btn btn-danger btn_delete' style='margin-left:4px;''><i class='fa fa-fw fa-times-circle'></i></a></td>";
        });
        $("#ContactTB tbody").html(row);
        $("#ContactTB").DataTable({
          processing: false,
          paging: false,
        });
      },
    });
  };

  get_data();

  $("#importExcel").on("click", function () {
    $("#inputFile").trigger("click");
  });

  //get uploaded file name
  $("#inputFile").on("change", function (e) {
    e.preventDefault();
    var fileInfo = e.target.files[0];

    var form_data = new FormData();
    // alert(fileInfo);
    // return;
    form_data.append("inputFile", fileInfo);

    for (var key of form_data.entries()) {
      console.log(key[0] + ", " + key[1]);
    }
    $.ajax({
      url: `${BASE_URL}Contact/importContact`,
      type: "post",
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (res) {
        $("#overlay").fadeOut(400);
        swal_alert("Success import data!");
        // if (res.code === 1) {
        //   $("#overlay").fadeOut(400);
        //   swal_alert(res.pesan);
        // } else {
        //   $("#overlay").fadeOut(400);
        //   swal_error(res.pesan);
        // }
        get_data();
      },
    });
  });

  //submit new data
  $("form#contactForm").on("submit", function (e) {
    e.preventDefault();
    // var name = $(elementContact.name).val();
    // console.log(name);
    // return;

    $.ajax({
      url: `${BASE_URL}Contact/storeData`,
      type: "post",
      data: {
        name: $(elementContact.name).val(),
        phone: $(elementContact.phone).val(),
        email: $(elementContact.email).val(),
      },
      dataType: "json",
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
        emptyContact();
        get_data();
        $("#modal-contact").modal("hide");
      },
    });
  });
});
