<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use App\Osms\Http\SMSClient;
use App\Osms\SMS;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Liste des agents';

        $search = $request->get('search', '');

        $agents = Agent::search($search)
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('app.agents.index', compact('agents', 'search', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('app.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:5',
            'phone' => 'required|min:9|unique:agents',
        ]);


        $agent = new Agent();
        $agent->identifiant = $this->identifiantGenerate();
        $agent->name = $request['name'];
        $agent->phone = $request['phone'];

        $agent->save();

        $message = "Bonjour " . $agent->name . ', votre identifiant est le ' . $agent->identifiant . '. Téléchargez via ce lien: https://sapguinee.com/apk/sapguinee.apk';


        $this->sendSMS($agent->phone, $message);

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {

        return view('app.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        return view('app.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'phone' => 'required|min:9|unique:agents,phone,' . $agent->id,
        ]);


        $agent->name = $request['name'];
        $agent->phone = $request['phone'];

        $agent->save();

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();

        return redirect(route('agents.index'));
    }

    public function identifiantGenerate()
    {
        $data = Agent::select('id')
            ->orderBy('id', 'desc')
            ->first();


        if ($data == null)
            $identifiant = "0" . rand(10, 99) . '' . rand(10, 99);

        elseif ($data->id < 10)
            $identifiant = ($data->id) . '' . rand(1000, 9999);

        else if ($data->id < 100)
            $identifiant = ($data->id) . '' . rand(100, 999);

        return $identifiant;

    }

    public function sendSMS($phone, $message)
    {
        $id = "lfVMJnbS0ZGBhxAM4i3UZrbluV5j6v3t";
        $secret = "ZOA2DjxMFAX1td4i";

        $client = SMSClient::getInstance($id, $secret);

        $token = $client->getToken(); //recuperation du token
        $expire = $client->getTokenExpiresIn(); // Validite du token, 3600s


        $sms = new SMS($client);

        $balance = $sms->realBalance('GIN'); //On recupere le nombre d'sms restant

        if ($balance['available'] != 0) // S'il en reste
        {

            $from = '+224620000000';
            $to = '+224' . $phone;


            $response = $sms->to($to)
                ->from($from, 'Kisal')
                ->message($message)
                ->send();

            if (isset($response['outboundSMSMessageRequest'])) {

            }
        }


    }
}
