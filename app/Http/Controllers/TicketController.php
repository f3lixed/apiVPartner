<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Ticket\TicketRepository;

class TicketController extends Controller
{

  protected $ticketRepo;

  public function __construct(TicketRepository $ticketRepository)
  {
      $this->ticketRepo = $ticketRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    echo json_encode($this->ticketRepo->getAll());
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $data = $this->ticketRepo->create($request->all());
      if ($data->id) {
        return response()->json([
            'response' => true,
            'id' => $data->id,
            'message' => '¡Bien! ticket creado correctamente.',
        ]);
      }
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Ticket  $ticket_id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $ticket_id)
  {
      $ticket = $this->ticketRepo->find($ticket_id);

      if (!is_null($ticket)) {
         $this->ticketRepo->update($ticket, $request->all());
         return response()->json([
             'response' => true,
             'id' => $ticket->id,
             'message' => '¡Bien! ticket editado correctamente.',
         ]);
      }
      return response()->json([
       'response' => false,
       'message' => 'Ha ocurrido un error, intente de nuevo.',
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Ticket  $ticket_id
   * @return \Illuminate\Http\Response
   */
  public function destroy($ticket_id)
  {
    $ticket = $this->ticketRepo->find($ticket_id);
         if (!is_null($ticket)) {
             $this->ticketRepo->delete($ticket);
             return response()->json([
                 'response' => true,
                 'id' => $ticket->id,
                 'message' => 'Ticket eliminado correctamente',
             ]);
         }
         return response()->json([
             'response' => false,
             'message' => 'Ha ocurrido un error, intente de nuevo.',
         ]);
  }
}
