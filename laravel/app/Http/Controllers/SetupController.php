<?php

namespace App\Http\Controllers;

use App\Actions\FAQ\FAQCreateAction;
use App\Actions\FAQ\FAQDeleteAction;
use App\Actions\FAQ\FAQListAction;
use App\Actions\FAQ\FAQShowAction;
use App\Actions\FAQ\FAQUpdateAction;
use App\Actions\Setup\AddRecipientAction;
use App\Actions\Setup\ChangeLoginImageAction;
use App\Actions\Setup\RemoveRecipientAction;
use App\Actions\Setup\SetupUpdateAction;
use App\Http\Requests\ChangeLoginImageRequest;
use App\Http\Requests\CreateFAQRequest;
use App\Http\Requests\UpdateFAQRequest;
use App\Http\Requests\UpdateRecipientRequest;
use App\Http\Requests\UpdateSetupRequest;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Recipient;
use App\Models\Setup;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        $terms_of_use=Setup::where('key', 'terms_of_use')->first();
        $privacy_policy=Setup::where('key', 'privacy_policy')->first();
        $categories = Category::with('recipients')->get();
//        $faqs = FAQ::with('category')->paginate($request->has('per_page') ? $request->per_page : config('paginate.page_count'));
//        $faqs = (new FAQListAction())->execute($filter=NULL, $count=config('paginate.page_count'));
        $faqs = FAQ::with('category')->paginate(config('paginate.page_count'));
        return view('setup.admin.index', ['terms_of_use'=>$terms_of_use, 'privacy_policy'=>$privacy_policy, 'categories'=>$categories,
            'faqs' => $faqs
        ]);

    }
    public function update(UpdateSetupRequest $request,$key)
    {

        $message='';
        $response = (new SetupUpdateAction())->execute($validatedData=$request->validated(),$key);
        if ($key == 'login_bg_image'){
            $message=  'Login Background Image Changed Successfully';
        }elseif ($key == 'terms_of_use'){
            $message='Terms of Use Updated Successfully';
        }else{
            $message='Privacy Policy Updated Successfully';
        }
        return redirect()->route('setup.index')->with('success', $message );
    }
    public function updateRecipient(UpdateRecipientRequest $request)
    {
        $response=(new AddRecipientAction())->execute($validatedData=$request->validated());
        if (response($response)->getStatusCode() == 200){
            return $response  = array('success' => '1', 'data'=>$response, 'message'=> 'New Recipient Added Successfully');
        }
    }
    public function removeRecipient($recipient_id)
    {
        $response=(new RemoveRecipientAction())->execute($recipient_id);
        if (response($response)->getStatusCode() == 200){
            return $response  = array('success' => '1', 'response'=>$response, 'message'=> 'Recipient Removed Successfully');
        }
    }

    /*
     *==================================================================================================================
     * FAQ
     *==================================================================================================================
     */

    public function faq(Request $request)
    {
        $response = (new FAQListAction())->execute(
            $filter = $request->has('search') ? $request->get('search') : NULL,
            $category_id = $request->has('category_id') ? $request->get('category_id') : NULL,
            $count = $request->has('per_page') ? $request->get('per_page') :config('paginate.page_count')
        );
//var_dump($request->wantsJson());die();
        return
            $request->wantsJson() ?
                $response
                : redirect()->route('setup.index')->with('success', 'FAQ Created Successfully' );
    }

    public function faqStore(CreateFAQRequest $request)
    {
        $response = (new FAQCreateAction())->execute($validatedData=$request->validated());

        return $request->wantsJson() ? array('success'=> 'FAQ Created Successfully') : redirect()->route('setup.index')->with('success', 'FAQ Created Successfully' );
    }

    public function faqShow($id, Request $request)
    {
        $response = (new FAQShowAction())->execute($id);

        return $request->wantsJson() ? array('data'=> $response) : redirect()->route('setup.index')->with('success', 'FAQ Created Successfully' );
    }

    public function faqUpdate(UpdateFAQRequest $request, $id)
    {
        $response = (new FAQUpdateAction())->execute($validatedData=$request->validated(), $id);

        return $request->wantsJson() ? array('success'=> '1', 'message'=>'FAQ Updated Successfully') : redirect()->route('setup.index')->with('success', 'FAQ Updated Successfully' );
    }

    public function faqDelete($id, Request $request)
    {
        $response = (new FAQDeleteAction())->execute($id);

        return $request->wantsJson() ? array('success'=> '1', 'message'=>'FAQ Deleted Successfully') : redirect()->route('setup.index')->with('success', 'FAQ Created Successfully' );
    }
}
