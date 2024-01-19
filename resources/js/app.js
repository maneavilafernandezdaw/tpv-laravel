import './bootstrap';



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
/* datatables */
$('#tabla_Datatables').DataTable({

    responsive: true,
    autoWidth: false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por páginas",
        "zeroRecords": "Nada encontrado - disculpa",
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

