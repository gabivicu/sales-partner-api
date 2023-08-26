<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * AuthorsController constructor.
     * @param Client $client
     * @param Lead $lead
     * @param JsonResponse $response
     */
    public function __construct(
        protected Client $client,
        protected Lead $lead,
        protected JsonResponse $response
    ) { }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $data = $this->validate($request,  array_merge($this->client->rules(), $this->lead->rules()));
            $clientData = Client::firstOrCreate(
                ['phone' => $data['phone'], 'email' => $data['email']],
                ['first_name' => $data['first_name'], 'last_name' => $data['last_name']]
            );
            $leadData = new Lead(['message' => $data['message']]);
            $clientData->leads()->save($leadData);

            return response()->json(['lead_id' => $leadData->id], Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->setData(['error' => $e->getMessage()]);
        }
    }
}
