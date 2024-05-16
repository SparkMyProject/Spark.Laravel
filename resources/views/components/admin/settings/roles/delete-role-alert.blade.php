
<script>

  document.addEventListener('DOMContentLoaded', (event) => {
    let deleteRoleButtons = document.querySelectorAll('.delete-role-button');
    deleteRoleButtons.forEach((button) => {
      button.onclick = function() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'This is a permanent action and cannot be undone.',
          icon: 'error',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete role!',
          customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function(result) {
          if (result.value) {
            // Get user ID from button data attribute
            let roleId = button.getAttribute('data-role-id');

            // Send POST request to server
            fetch(`/admin/settings/roles/delete/${roleId}`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                // Include CSRF token in header for Laravel
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
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
                    title: 'Role has been deleted.',
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
