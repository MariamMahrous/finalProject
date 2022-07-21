<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //  $user = Auth::user();
        //  $clients = Client::all()->where('user_id', $user->id);
        $clients=auth()->user()->clients;
         return view("clients.index",["clients"=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>'required|max:100|string',
            "adress"=>'required|max:255|string',
            "phone_number"=>'required|numeric',
        
                ]);
                 $client=new Client(request()->all());
                 $client->user_id = Auth::user()->id;
                 $client->save();
                 return redirect()->route("clients.index");
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view("clients.show", ["clients"=>$client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        // $client = Client::findOrFail($id);
        
        return view('clients.edit', ["clients"=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Client $client, Request $request)
    {
        $request->validate([
            "name"=>'required|max:100|string',
            "adress"=>'required|max:255|string',
            "phone_number"=>'required|numeric',
        
                ]);
                $client->update($request->all());
                return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
    
        $client->delete();
         return redirect()->route('clients.index');
    }
}
