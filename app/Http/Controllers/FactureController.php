<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Client;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    public function generatePDF($id_client)
    {
        $client = Client::find($id_client);

        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $bill = Bill::where('client_id', $client->id)->first();

        if (!$bill) {
            return response()->json(['error' => 'Factura no encontrada para el cliente'], 404);
        }

        $orders = Order::withTrashed()->with('product')->where('bill_id', $bill->id)->get();
        $totalValue = $orders->sum('total_price');
        $pdf = Pdf::loadView('module.facture.facture', compact('client', 'bill', 'orders', 'totalValue'));

        return $pdf->stream('factura_' . $client->name_client . '.pdf');
    }

}
