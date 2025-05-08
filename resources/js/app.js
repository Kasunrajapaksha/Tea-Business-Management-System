import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

//permission-index-getPrmissionByRole
$(document).ready(function() {
    $('#role_id').on('change', function() {
        var roleId = $(this).val();
        if (roleId != '') {
            $.ajax({
                url: '/admin/permission/' + roleId + '/rolePermission',
                method: 'GET',
                success: function(data) {
                    $('input[name="permissions[]"]').prop('checked', false);
                    data.forEach(function(permission) {
                        $('input[data-permission-id="' + permission.id + '"]').prop('checked', true);
                    });
                },
                error: function() {
                    alert('Failed to load permissions');
                }
            });
        } else {
            $('input[name="permissions[]"]').prop('checked', false);
            alert('Please select a valid role.');
            return;
        }
    });
});

//alert-auto-close
window.addEventListener('DOMContentLoaded', function(){
    this.setTimeout(function(){
        const closeButton = document.getElementById('alert-close-btn');
        if(closeButton){
            closeButton.click();
        }
    }, 5000);
});



