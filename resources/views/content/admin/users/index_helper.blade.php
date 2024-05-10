
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    let disableUserButtons = document.querySelectorAll('.disable-user-button');
    let enableUserButtons = document.querySelectorAll('.enable-user-button');
    disableUserButtons.forEach((button) => {
      button.onclick = function() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You can enable this user later!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, disable user!',
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
            fetch('/admin/users/disable', {
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
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(data => {
                // Handle server response here
                if (data["code"] == 200) {
                  Swal.fire({
                    icon: 'success',
                    title: 'User has been disabled.',
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
    enableUserButtons.forEach((button) => {
      button.onclick = function() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You can disable this user later!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, enable user!',
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
            fetch('/admin/users/enable', {
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
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(data => {
                // Handle server response here
                if (data["code"] == 200) {
                  Swal.fire({
                    icon: 'success',
                    title: 'User has been enabled!',
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
