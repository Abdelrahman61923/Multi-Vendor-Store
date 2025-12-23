<?php

namespace App\Http\Controllers;

use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductsController extends Controller
{
    public function create()
    {
        return view('dashboard.products.import');
    }

    public function store(Request $request)
    {
        $job = new ImportProducts($request->post('name'));
        $job->onQueue('import')->delay(now()->addSeconds(5));
        dispatch($job);

        return redirect()->route('dashboard.products.index')->with([
            'seccsee' => 'Import is runing...',
        ]);
    }
}
