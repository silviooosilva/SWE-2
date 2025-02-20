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
  }
  );  
});
