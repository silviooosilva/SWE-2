const baseURL = window.location.origin + '/clarifiquei';

$(document).ready(function () {
  $('#loginForm').submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
        $.ajax({
      url: baseURL + '/app/Controllers/loginController.php?action=login',
      type: 'POST',
      data: data,
          success: function (response) {
                console.log(response);
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
           }, 1300);
          
          window.location.href = baseURL + '/home.php';
          
        } else {
          Swal.fire({
            title: 'Erro!',
            text: responseJSON.message,
            icon: 'error',
            confirmButtonText: 'OK'
          });
           setTimeout(function () {
            location.reload();
          }, 1500);
        }
      }
    });

  });
});