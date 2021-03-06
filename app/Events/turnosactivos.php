<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class turnosactivos implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Turno;
    public $Nombre;
    public $Cantidad;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Int $Turno, String $Nombre, Int $Cantidad )
    {
        //
        $this->Turno = $Turno;
        $this->Nombre = $Nombre;
        $this->Cantidad = $Cantidad;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
         return new Channel('turnos');
        //return new PrivateChannel('channel-name');
    }

    public function broadcastAs()
    {
        //return new PrivateChannel('channel-name');
        return "turnosactivos";
    }
}
