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
        console.log(responseJSON);
        if (responseJSON.status === 'success') {
          $('#formTask')[0].reset();
          $('#exampleModalTarefa').modal('hide');
          Swal.fire({
            title: 'Sucesso!',
            text: responseJSON.message,
            icon: 'success',
            confirmButtonText: 'OK'
          });
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
  
  
  
  $('#startTask').on('click', function () {
    let id = $('#startTask').val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=startTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        if (responseJSON.status === 'success') {
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
          setTimeout(function () {
            location.reload();
          }, 1200);
        }
        
      }
    });
  });
  
    $('#finishTask').on('click', function () {
    let id = $('#finishTask').val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=finishTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        if (responseJSON.status === 'success') {
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
          setTimeout(function () {
            location.reload();
          }, 1200);
        }
        
      }
    });
  });
  
      $('#closeTask').on('click', function () {
    let id = $('#closeTask').val();
    $.ajax({
      url: baseURL + '/app/Controllers/taskController.php?action=closeTask',
      type: 'POST',
      data: { id: id },
      success: function (response) {
        let responseJSON = JSON.parse(response);
        if (responseJSON.status === 'success') {
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
          setTimeout(function () {
            location.reload();
          }, 1200);
        }
        
      }
    });
  });
  
});