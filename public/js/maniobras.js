(function() {
    $( "#formAsistencia" ).on( "submit", function( event ) {

     event.preventDefault();
     createAsistencias(this);
     });
})();

function createAsistencias(form){

    const data = {
        'turno_id': $('#turno_id').val(),
        'user_id': $('#user_id').val(),
        'monto_id': $('#monto_id').val(),
        'documento_id' : $('#documento_id').val(),
        'asistencia': $('#asistencia').val(),

    }
    console.log('submit');
    $.ajax ({
         type:'post',
         url:'/asistencias',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         data:data,
         success: function(resp){
             $("#respa").html(resp);
         },
         error: function(error){

         }
     });
}
