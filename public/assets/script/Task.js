$(document).ready(function () {
  $('#formTask').on('submit', function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=store',
      type: 'POST',
      data: data,
      success: function (response) {
        let responseJSON = JSON.parse(response);
        if (responseJSON.status === 'success') {
          $('#formTask')[0].reset();
          $('#exampleModalTarefa').modal('hide');
          Swal.fire({
            title: 'Sucesso!',
            text: responseJSON.message,
            icon: 'success',
            confirmButtonText: 'OK'
          });
          
          setTimeout(function () {
          location.reload();
        }, 1200);
          
        } else {
          Swal.fire({
            title: 'Erro!',
            text: responseJSON.message,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }
    });
  });

  $(document).on('click', '.startTask', function () {
    let id = $(this).val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=startTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        Swal.fire({
          title: responseJSON.status === 'success' ? 'Sucesso!' : 'Erro!',
          text: responseJSON.message,
          icon: responseJSON.status,
          confirmButtonText: 'OK'
        });
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    });
  });

  $(document).on('click', '.finishTask', function () {
    let id = $(this).val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=finishTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        Swal.fire({
          title: responseJSON.status === 'success' ? 'Sucesso!' : 'Erro!',
          text: responseJSON.message,
          icon: responseJSON.status,
          confirmButtonText: 'OK'
        });
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    });
  });

  $(document).on('click', '.closeTask', function () {
    let id = $(this).val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=closeTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        Swal.fire({
          title: responseJSON.status === 'success' ? 'Sucesso!' : 'Erro!',
          text: responseJSON.message,
          icon: responseJSON.status,
          confirmButtonText: 'OK'
        });
        setTimeout(function () {
          location.reload();
        }, 900);
      }
    });
  });
});