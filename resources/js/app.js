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

    const fetchRoles = (departmentId) => {
        roleSelect.innerHTML = '<option value="#">Choose a role</option>';
        roleSelect.disabled = false;

        if (departmentId !== '#') {
            fetch(`/get-roles/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    data.roles.forEach(function(role) {
                        const option = document.createElement('option');
                        option.value = role.id;
                        option.textContent = role.role_name;
                        roleSelect.appendChild(option);
                    });

                    const preSelectedRoleId = roleSelect.dataset.selectedRoleId;
                    if (preSelectedRoleId) {
                        roleSelect.value = preSelectedRoleId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching roles:', error);
                    roleSelect.disabled = true;
                });
        } else {
            roleSelect.disabled = true;
            roleSelect.innerHTML = '<option value="#">Choose a role</option>';
        }
    };

    departmentSelect.addEventListener('change', function() {
        const departmentId = this.value;
        fetchRoles(departmentId);
    });

    const departmentId = departmentSelect.value;
    fetchRoles(departmentId);
});


document.addEventListener('DOMContentLoaded', function () {
    const accountInput = document.getElementById('bank_details');
    const bankSelect = document.getElementById('bank_id');

    const fetchBanks = async () => {
        try {
            const response = await fetch('/get-bank-by-code');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching bank data:', error);
            return [];
        }
    };

    const matchBankByAccountNumber = (banks, accountNumber) => {
        for (const bank of banks) {
            const bankCode = bank.bank_code;
            if (accountNumber.startsWith(bankCode)) {
                return bank.id;
            }
        }
        return null;
    };

    accountInput.addEventListener('input', async function () {
        const accountNumber = this.value;

        if (accountNumber.length >= 1) {
            const banks = await fetchBanks();
            const matchedBankId = matchBankByAccountNumber(banks, accountNumber);

            if (matchedBankId) {
                bankSelect.value = matchedBankId;
            } else {
                bankSelect.value = '#';
            }
        }
    });
});














