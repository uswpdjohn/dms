<?php

namespace App\Actions\CapTable;

use App\Actions\DocumentManagement\DeleteDocumentAction;
use App\Actions\DocumentManagement\EditDocumentAction;
use App\Actions\DocumentManagement\GenerateSigningFieldAction;
use App\Actions\SignNow\signNowOAuthAction;
use Helper\Str;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
//use Mpdf\Mpdf\Config\ConfigVariables;
//use Mpdf\Mpdf\Config\FontVariables;
use PHPUnit\Exception;
use SignNow\Api\Entity\Auth\Token;
use SignNow\Api\Entity\Document\Document;
use SignNow\Api\Entity\Document\Upload as DocumentUpload;
use App\Models\CompanyMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Mpdf\Mpdf;
use Throwable;

class CapTableShareCertificateCreateAction
{
    public function execute($validatedData)
    {
        try {
                /*Start Generating PDF*/
                $pdf=$this->generateShareCertificatePdf($validatedData);
                /*End Generating PDF*/

                /*Abandoned*/
//                $entityManager=(new signNowOAuthAction())->execute();
//                $content= public_path('images/shareCertificate/'.$pdf['fileName']);
//                $uploadFile = (new DocumentUpload(new \SplFileInfo($content)));
//                $uploaded_doc = $entityManager->create($uploadFile);
//                $document = $entityManager->get(new Document(), ['id' => $uploaded_doc->getId()]);
//
//                /*start storing document thumbnail to local storage*/
//                $thumbnail_link=$document->getThumbnail()->getMedium();
//                $entity=$entityManager->get(Token::class); //good
//                $access_token=$entity->getAccessToken(); //good
//                $link= $thumbnail_link.'&access_token='.$access_token;
//                $contents=$this->curl_get_file_contents($link);
//                file_put_contents(public_path('images/thumbnail/'.$document->getId().'.png'),$contents); //put the content in local storage
//                unlink(public_path('images/shareCertificate/'.$pdf['fileName'])); //good
                /*Abandoned*/
                /*end storing document thumbnail to local storage*/
                /*Abandoned*/
//                $validatedData['document_id'] = $document->getId(); //will be valid when using signNow
                /*Abandoned*/
                $validatedData['document_id'] = \Illuminate\Support\Str::random(40);
                $validatedData['file']= $pdf['fileName'];
                if(key_exists('share_certificate', $validatedData)){
                    $response = (new UpdateShareCertificateAction())->execute($validatedData);
                    /*Abandoned*/
//                    (new GenerateSigningFieldForShareCertificateAction())->execute($validatedData);
                    /*Abandoned*/
                    (new DeleteDocumentAction())->execute($validatedData['share_certificate_document_hash_id']);
                    return ['success'=>true,'share_certificate' => $response,'message' => 'Share Certificate Updated Successfully'];

                }else{
                    $response = (new StoreShareCertificateAction())->execute($validatedData);

                    /*Abandoned*/
//                    if(key_exists('secretary',$validatedData) || key_exists('director',$validatedData)){
//                        (new GenerateSigningFieldForShareCertificateAction())->execute($validatedData);
//                    }
                    /*Abandoned*/
                    return ['success'=>true,'share_certificate' => $response,'message' => 'Share Certificate Created Successfully'];
                }
                /*Abandoned*/
//                if(key_exists('share_certificate', $validatedData)){
////                    return ['success'=>true,'document'=>$document,'message' => 'Share Certificate Updated Successfully']; //will be valid when using signNow
//                    return ['success'=>true,'message' => 'Share Certificate Updated Successfully'];
//                }
//                return ['success'=>true,'document'=>$document,'message' => 'Share Certificate Created Successfully']; //will be valid when using signNow

//            }
                /*Abandoned*/

        }catch (Throwable $exception){
//            return ['success'=>false,'message'=>$exception->getMessage()];
            throw new \Exception('ERROR [SignNow API]: ' . $exception->getMessage());
        }

    }

    private function generateShareCertificatePdf($validatedData): array
    {
        try {

            $certify_to = CompanyMember::where('id', $validatedData['company_member_id'])->first();
            $exploded_address_line = explode(' ', $validatedData['company_address_line']);
            $addressLine_2_spliced = array_splice($exploded_address_line, count($exploded_address_line)-2); //included Registered Office Country & Postal code
            $addressLine_1=implode(' ',$exploded_address_line);
            $addressLine_2=implode(' ',$addressLine_2_spliced);

//            $fileName = '-ShareCertificate-'.$validatedData['share_certificate_id'].'.pdf';
            $fileName = time() .'-Share Certificate Of-'.$certify_to->name.'.pdf';
            /*Start Custom Font integration*/
            $NewFontDirs = [
                public_path('assets/fonts'),
            ];
            $defaultConfig = (new ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
            /*End Custom Font integration*/
            $mpdf = new Mpdf([
                'fontDir' => array_merge($fontDirs, $NewFontDirs),
                'fontdata' => $fontData + [
                    // lowercase letters only in font key
                        'arial' => [
                            'R' => 'arial.ttf'
                        ]
                    ],
//                'format' => [311,200],
                'format' => 'A4-L',
                'orientation' => 'L',
                'margin_top' => 10,
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_bottom' => 10,
            ]);

            $html = \view('capTableShareCertificate.admin.pdf.shareCertificatePdf', compact( 'certify_to', 'validatedData', 'addressLine_1','addressLine_2'));
            $stylesheet1 = file_get_contents(public_path('assets/css/invoice.css'));

            $html = $html->render();
            $mpdf->SetTitle('Share Certificate-'.$validatedData['share_certificate_id']);
            $mpdf->WriteHTML($stylesheet1, 1);
            $mpdf->WriteHTML($html, 0);
            $path = public_path('images/shareCertificate/');
            if(!File::exists($path)){
                mkdir($path);
            }
            $mpdf->Output($path.$fileName, 'F');
            return ['dir'=>$path, 'fileName'=>$fileName];
        }catch (\Exception $exception){
            throw new \Exception('from pdf '.$exception->getMessage());
        }
    }
    private function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }

}
