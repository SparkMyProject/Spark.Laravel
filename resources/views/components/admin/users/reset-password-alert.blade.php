
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    let resetPasswordButton = document.querySelectorAll('.reset-password-button');
    resetPasswordButton.forEach((button) => {
      button.onclick = function() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'This action is non-reversible.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, reset password!',
          customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function(result) {
          if (result.value) {
            // Get user ID from button data attribute
            let userId = button.getAttribute('data-user-id');
            // Send POST request to server
            fetch('/admin/users/reset-password', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                // Include CSRF token in header for Laravel
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({ userId: userId }) // send user ID in request body
            })
              .then(response => {
                if (!response.ok) {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "A server error has occurred. Please try again.",
                    customClass: {
                      confirmButton: 'btn btn-primary'
                    }
                  });
                  return;
                }
                data = response.json();
                // Handle server response here
                if (data["code"] === 200) {
                  Swal.fire({
                    icon: 'success',
                    title: 'User\'s password has been reset..',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((result) => {
                    location.reload();
                  });

                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data["message"],
                    customClass: {
                      confirmButton: 'btn btn-primary'
                    }
                  });
                }
              })
              .catch((error) => {
                console.error('Error:', error);
              });
          }
        });
      };
    });
  });
</script>
