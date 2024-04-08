import './bootstrap';

import * as bootstrap from 'bootstrap';

import Alpine from 'alpinejs';

/* import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss'; */

window.Alpine = Alpine;

Alpine.start();
/* datatables */
$('#tabla_Datatables').DataTable({

    responsive: true,
    autoWidth: false,
    "order": [[0, "desc"]],
    "lengthMenu": [5, 10, 20],
    "language": {
       
        "lengthMenu": "Mostrar _MENU_ registros por páginas",
        "zeroRecords": "Nada encontrado",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtrado de _MAX_ registros)",
        "search": "Buscar:",
        "paginate": {
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});
/* imagenes */
$(document).ready(function(e) {
    $('#imagen').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imagenSeleccionada').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });



});
