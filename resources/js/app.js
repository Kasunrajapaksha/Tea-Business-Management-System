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







