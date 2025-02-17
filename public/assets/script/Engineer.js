const baseURL = window.location.origin + '/clarifiquei';

$(document).ready(function () {
  $('#formEngineer').on('submit', function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
      url: baseURL + '/app/Controllers/engineerController.php?action=store',
      type: 'POST',
      data: data,
      success: function (response) {
        let responseJSON = JSON.parse(response);
        console.log(responseJSON);
        if (responseJSON.status === 'success') {
          $('#formEngineer')[0].reset();
          $('#exampleModal').modal('hide');
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
  }
  );  
});
