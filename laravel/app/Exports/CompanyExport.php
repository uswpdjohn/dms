<?php

namespace App\Exports;

use App\Models\Company;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Throwable;

class CompanyExport implements FromQuery, ShouldQueue,WithHeadings,WithMapping,ShouldAutoSize,WithStyles
{

    use Exportable;
    public function query()
//    public function collection()
    {

//        return Company::query()->select('name', 'fye');
        return Company::query()->with(['primary_industry_service_ssic','secondary_industry_service_ssic'])
            ->select('name', 'status', 'fye','uen','address_line', 'incorporation_date', 'last_agm_filed', 'last_ar_filed','primary_industry_service_ssic_id', 'secondary_industry_service_ssic_id');
//        return Company::select('name', 'fye');
    }
    public function headings(): array
    {
        return [
            'UEN',
            'Company Name',
            'Incorporation Date',
            'Last AGM Filed',
            'Last AR Filed',
            'FYE',
            'Status',
            'Address Line',
            'Business Activity 1',
            'Business Activity 2',
        ];
    }
    public function map($company): array
    {
        $last_agm_filed='';
        if ($company->last_agm_filed != null){
            $last_agm_filed = Carbon::parse($company->last_agm_filed)->format('d-M-Y');
        }else{
            $last_agm_filed = '--';
        }
        $last_ar_filed='';
        if ($company->last_ar_filed != null){
            $last_ar_filed = Carbon::parse($company->last_ar_filed)->format('d-M-Y');
        }else{
            $last_ar_filed = '--';
        }
        $secondary_industry_service='';
        if($company->secondary_industry_service_ssic_id != null){
            $secondary_industry_service = $company->secondary_industry_service_ssic->code.' - '.$company->secondary_industry_service_ssic->title;
        }else{
            $secondary_industry_service = '--';
        }

        return [
            $company->uen,
            $company->name,
            Carbon::parse($company->incorporation_date)->format('d-M-Y'),
            $last_agm_filed,
            $last_ar_filed,
            Carbon::parse($company->fye)->format('d M'),
            $company->status,
            $company->address_line,
            $company->primary_industry_service_ssic->code.' - '.$company->primary_industry_service_ssic->title,
            $secondary_industry_service
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    public function failed(Throwable $exception): void
    {
        // handle failed export
    }
}
