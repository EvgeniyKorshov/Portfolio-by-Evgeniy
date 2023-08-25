<?php

namespace App\Http\Controllers;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use App\Models\Dadata;
use Illuminate\Http\Request;

class DadataController extends Controller
{

public function show(Request $request)
    {
        try{
        $inn = $request->input('inn');
        $dadata = DaDataCompany::id($inn, 1, null, BranchType::MAIN, CompanyType::LEGAL); // 7707083893
        $model = Dadata::create([
            'type' => $dadata['suggestions'][0]['value'],
            'inn' => $dadata['suggestions'][0]['data']['inn'],
            'ogrn' => $dadata['suggestions'][0]['data']['ogrn'],
            'phone' => $dadata['suggestions'][0]['data']['phones'],
            'email' => $dadata['suggestions'][0]['data']['emails'],
            'manager_name' => $dadata['suggestions'][0]['data']['management']['name'],
            'manager_post' => $dadata['suggestions'][0]['data']['management']['post'],
            'full_address' => $dadata['suggestions'][0]['data']['address']['unrestricted_value'],
            'name' => $dadata['suggestions'][0]['data']['name']['full_with_opf'],
        ]);
        return redirect('/');
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

