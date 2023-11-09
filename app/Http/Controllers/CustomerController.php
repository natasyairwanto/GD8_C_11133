<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        //get customer
        $customer = Customer::latest()->paginate(5);
        //render view with posts
        $tickets = Ticket::all();
        return view('customer.index', compact('customer', 'tickets'));
    }

    public function create()
    {
        $tickets = Ticket::all();
        return view('customer.create', compact('tickets'));
    }

    public function store(Request $request)
    {
    $validationRules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'quantity' => 'required',
        'ticket' => 'required',

    ];

    $message = [
        'name.required' => 'Name tidak boleh kosong !',
        'email.required' => 'Email tidak boleh kosong !',
        'phone.required' => 'Phone tidak boleh kosong !',
        'quantity.required' => 'Quantity tidak boleh kosong !',
        'ticket.required' => 'Harus pilih salah satu ticket !',
    ];

    $this->validate($request, $validationRules, $message);

    $customer = Customer::create([
        'id_ticket' => $request->ticket,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'quantity' => $request->quantity,

    ]);

    return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'ticket' => 'required',
        ];

        $this->validate($request, $validationRules);

        $customer = Customer::find($id);

        $customer->id_ticket = $request->ticket;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->quantity = $request->quantity;
        $customer->save();

        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        $tickets = Ticket::all();
        return view('customer.edit', compact('customer', 'tickets'));
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
