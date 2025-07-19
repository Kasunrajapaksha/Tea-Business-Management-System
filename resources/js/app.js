import './bootstrap';
import $ from 'jquery';


window.$ = window.jQuery = $;


// alert-auto-close
window.addEventListener('DOMContentLoaded', function(){
    this.setTimeout(function(){
        const closeButton = document.getElementById('alert-close-btn');
        if(closeButton){
            closeButton.click();
            window.location.reload();
        }
    }, 5000);
});


document.addEventListener('DOMContentLoaded', function () {
    var table = $('table[id="dataTable"]').each(function () {
        $(this).DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "Search records:",
                lengthMenu: "Show _MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            layout: {
                top1Start: {
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: ['copy', 'pdf', 'excel', 'print']
                        },
                    ]
                }
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('user_department_id');
    const roleSelect = document.getElementById('user_role_id');

    // Function to fetch roles based on the selected department
    const fetchRoles = (departmentId) => {
        // Reset the role dropdown before fetching new data
        roleSelect.innerHTML = '<option value="#">Choose a role</option>'; // Reset to default
        roleSelect.disabled = false; // Enable the role dropdown

        // If a valid department is selected, fetch roles
        if (departmentId !== '#') {
            // Make the AJAX request to get roles based on the department ID
            fetch(`/get-roles/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the role dropdown with new options
                    data.roles.forEach(function(role) {
                        const option = document.createElement('option');
                        option.value = role.id;
                        option.textContent = role.role_name;
                        roleSelect.appendChild(option);
                    });

                    // Pre-select the role if the current user's role is part of the available roles
                    const preSelectedRoleId = roleSelect.dataset.selectedRoleId;
                    if (preSelectedRoleId) {
                        roleSelect.value = preSelectedRoleId; // Set pre-selected role if available
                    }
                })
                .catch(error => {
                    console.error('Error fetching roles:', error);
                    // Optionally disable role dropdown if an error occurs
                    roleSelect.disabled = true;
                });
        } else {
            // If no department is selected, disable the role dropdown
            roleSelect.disabled = true;
            roleSelect.innerHTML = '<option value="#">Choose a role</option>'; // Reset role dropdown to default
        }
    };

    // Event listener for department selection change
    departmentSelect.addEventListener('change', function() {
        const departmentId = this.value;
        fetchRoles(departmentId);  // Fetch roles based on the selected department
    });

    // Initialize role dropdown based on the pre-selected department when the page loads
    const departmentId = departmentSelect.value;
    fetchRoles(departmentId);  // Call the function to populate roles based on the selected department
});








