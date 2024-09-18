<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Execute the job.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function handle()
    {
//        $contents = file_get_contents(storage_path('app/public/companies.xlsx'));
////        dd($contents);
//
//        $file=file_put_contents(public_path('companies.xlsx'),$contents);
//        return response()->download('companies.xlsx');
//        dd(Storage::get());

//        return Storage::download('public/companies.xlsx');
//        $response = storage_path();
//
//        return response()->download($response);
    }
}
