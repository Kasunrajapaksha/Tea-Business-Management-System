import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;


//alert-auto-close
window.addEventListener('DOMContentLoaded', function(){
    this.setTimeout(function(){
        const closeButton = document.getElementById('alert-close-btn');
        if(closeButton){
            closeButton.click();
        }
    }, 5000);
});



