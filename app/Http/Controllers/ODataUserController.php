<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Flat3\Lodata\Facades\Lodata;
use Illuminate\Support\Facades\Http;


class ODataUserController extends Controller
{
    // public function index()
    // {

    //     $users = User::paginate(10);
    //     $userList = User::all(); 
        
    //     $regionCounts = [];
    //     foreach ($userList as $user) {
    //         $region = $user->region;
    //         if (isset($regionCounts[$region])) {
    //             $regionCounts[$region]++;
    //         } else {
    //             $regionCounts[$region] = 1;
    //         }
    //     }

    //     $regionWiseData = [
    //         'labels' => array_keys($regionCounts),
    //         'data' => array_values($regionCounts),
    //     ];
       
    //     // Pass data to the view using an array
    //     return view('users')->with([
    //         'users' => $users,
    //         'regionWiseData' => $regionWiseData
    //     ]);
    // }

    public function index()
    {
        // Fetch data from the OData endpoint
        $response = Http::get('http://127.0.0.1:8000/odata/Users');

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            // Decode the JSON response
            $userData = $response->json();

            // Process the data
            $regionCounts = [];
            foreach ($userData as $user) {
                $region = $user['region']; // Assuming 'region' is the key for region data
                if (isset($regionCounts[$region])) {
                    $regionCounts[$region]++;
                } else {
                    $regionCounts[$region] = 1;
                }
            }

            $regionWiseData = [
                'labels' => array_keys($regionCounts),
                'data' => array_values($regionCounts),
            ];

            // Pass data to the view using an array
            return view('users')->with([
                'users' => $userData,
                'regionWiseData' => $regionWiseData
            ]);
        } else {
            // If the request was not successful, handle the error
            // For example, you can return an error message or redirect back
            return redirect()->back()->with('error', 'Failed to fetch data from OData service');
        }
    }
    
}
