  var pusher = new Pusher('2c88f38b3dec05291a65', {
      cluster: 'us2'
  });

  /*
  var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
      console.log(JSON.stringify(data));
  });
  */

  var channel = pusher.subscribe('turnos');
      channel.bind('turnosactivos', (data)  =>
   {
       let contentAsistencia =
       '<div class="btn btn-outline-success" style="width:100%; margin-top:2px;" >'
      contentAsistencia+=
      `<div class="row">
         <span class="col-6">Nombre:</span>
         <span class="col-6">${data.Nombre}</span>
       </div>
      <div class="row">
        <span class="col-6">Cantidad:</span>
      <span class="col-6">${data.Cantidad}</span>
      </div>`
      //console.log(JSON.stringify(data));
      const userContent = $("#noti-asistencia-"+data.Turno+" .content");

      userContent.append(contentAsistencia);
    });
