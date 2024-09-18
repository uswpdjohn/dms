<?php

namespace App\Http\Controllers;

use App\Actions\User\UserBulkDeleteAction;
use App\Actions\User\UserDestroyAction;
use App\Actions\User\UserFilterByDesignationAction;
use App\Actions\User\UserFilterByNameAction;
use App\Actions\User\UserListAction;
use App\Actions\User\UserSearchAction;
use App\Actions\User\UserShowAction;
use App\Actions\User\UserUpdateAction;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserSignUpRequest;
use App\Interfaces\User\GetUserInterface;
use App\Interfaces\User\StoreUserInterface;
use App\Models\Setup;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        if (auth()->guard('web')->user()->can('create.user_management') ||
            auth()->guard('web')->user()->can('edit.user_management') ||
            auth()->guard('web')->user()->can('view.user_management') ||
            auth()->guard('web')->user()->can('delete.user_management') ) {
            try {
                $arr = $this->getPermission();
                $module = [];
                $permissions = [];
                foreach ($arr as $item) {
                    array_push($module, explode('.', $item->name)[1]);
                    if (explode('.', $item->name)[0] != 'index') {
                        array_push($permissions, ['permission' => $item->name, 'id' => $item->id]);
                    }
                }
                $uniqueModuleName = array_unique($module);
                //            $roles=Role::whereNotIn('name', ['Super Admin'])->get();



                $users = (new UserListAction())->execute($request->search, $request->has('per_page') ? $request->per_page : config('paginate.page_count'), 'DESC', $request);
                $designations = User::orderBy('designation', 'ASC')->pluck('designation');
                $designation = [];
                foreach ($designations as $des) {
                    $designation[] = $des;
                }
                if ($request->ajax()) {
                    //for pagination
                    $users = (new UserListAction())->execute($request->search, $request->has('per_page') ? $request->per_page : config('paginate.page_count'), 'DESC', $request);
                    //                return response()->json($users);
                    return $users;
                }
                //            return $users;
                return view('user.index', ['uniqueModuleName' => $uniqueModuleName, 'permissions' => $permissions, 'users' => $users, 'designations' => array_unique($designation)]);
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
        } else {
            abort(403, 'You do not have access to this action!');
        }
//
    }

    public function manageAction()
    {
        $arr = $this->getPermission();
        $module = [];
        $permissions = [];
        foreach ($arr as $item) {
//            var_dump(explode('.', $item->name));
//            die();
            array_push($module, explode('.', $item->name)[1]);
            if (explode('.', $item->name)[0] != 'index') {
                array_push($permissions, ['permission' => $item->name, 'id' => $item->id]);
            }
        }
        $uniqueModuleName = array_unique(array_diff($module, ['billing_admin', 'billing_customer', 'document_management_admin', 'document_management_customer', 'support_ticket_admin', 'support_ticket_customer', 'mailbox_admin', 'mailbox_customer', 'admin_dashboard', 'customer_dashboard']));
        return ['uniqueModuleName' => $uniqueModuleName, 'permissions' => $permissions];
    }

    public function search(Request $request, $search)
    {
//        $users = (new UserListAction())->execute($search, config('paginate.page_count'), 'DESC',$request);
        $users = (new UserSearchAction())->execute($search, config('paginate.page_count'), 'DESC', $request);
        return $users;
    }

    public function filterByDesignation(Request $request, $designation)
    {
//        $users = (new UserListAction())->execute($designation, config('paginate.page_count'), 'DESC',$request);
        $users = (new UserFilterByDesignationAction())->execute($designation, config('paginate.page_count'), 'DESC', $request);
        return $users;
    }


    public function signUpForm()
    {
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        return view('auth.signup', ['login_bg_image' => $login_bg_image['value']]);
    }

    public function requestSignUp(UserSignUpRequest $request, StoreUserInterface $interface)
    {
//        $response = (new UserRequestSignUpAction())->execute($validatedData = $request->validated());
        $response = $interface->execute($validatedData = $request->validated());
        if (key_exists('success', $response)){
            return redirect()->route('request.signUp.mailSent');
        }elseif (key_exists('send_mail', $response)){
           return redirect()->route('signup')->with('error', 'An error occurred. Please try again after sometime');
        }elseif (key_exists('user_exists', $response)){
           return redirect()->route('signup')->with('error',$response['message']);
        }
    }

    public function requestSignUpMailSent()
    {
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        return view('auth.signup_mailsent', ['login_bg_image' => $login_bg_image['value']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function getPermission()
    {
        return Permission::select('id', 'name')->get();
    }


    public function store(CreateUserRequest $request, StoreUserInterface $interface)
    {
        $responseArray= array();
//        $response = (new UserCreateAction())->execute($validatedData = $request->validated());
        $response = $interface->execute($request->validated());

        if (key_exists('success', $response)){
            $responseArray = array(
                'success' => '1',
                'message' => $response['message']
            );
        }elseif (key_exists('send_mail', $response)){
            $responseArray = array(
                'error' => '0',
                'message' => 'An error occurred when notifying via email'
            );
        } else{
            $responseArray = array(
                'error' => '0',
                'message' => 'User creation failed!'
            );
        }
        return $request->wantsJson() ? response()->json($responseArray) : redirect()->route('user.index')->with('success', 'User Created Successfully');
    }

    public function edit($slug, GetUserInterface $interface)
    {
        if (auth()->guard('web')->user()->can('edit.user_management')) {
            try {
                $arr = $this->getPermission();
                $module = [];
                $permissions = [];
                foreach ($arr as $item) {
                    array_push($module, explode('.', $item->name)[1]);
                    if (explode('.', $item->name)[0] != 'index') {
                        array_push($permissions, ['permission' => $item->name, 'id' => $item->id]);
                    }
                }
                $uniqueModuleName = array_unique(array_diff($module,
                    [
                        'billing_admin',
                        'billing_customer',
                        'document_management_admin',
                        'document_management_customer',
                        'support_ticket_admin',
                        'support_ticket_customer',
                        'mailbox_admin',
                        'mailbox_customer',
                        'admin_dashboard',
                        'customer_dashboard']));
                $user = $interface->execute(['slug' => $slug]);
//                return $user;
                return ['user' => $user, 'uniqueModuleName' => $uniqueModuleName, 'permissions' => $permissions];
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return $response = array('abort' => '403', 'message' => 'You do not have access to this action!');
        }
    }


    public function show($slug, GetUserInterface $interface)
    {
        if (auth()->guard('web')->user()->can('view.user_management')) {
            try {
                $arr = $this->getPermission();
                $module = [];
                $permissions = [];
                foreach ($arr as $item) {
                    array_push($module, explode('.', $item->name)[1]);
                    if (explode('.', $item->name)[0] != 'index') {
                        array_push($permissions, ['permission' => $item->name, 'id' => $item->id]);
                    }
                }
                $uniqueModuleName = array_unique(array_diff($module,
                    [
                        'billing_admin',
                        'billing_customer',
                        'document_management_admin',
                        'document_management_customer',
                        'support_ticket_admin',
                        'support_ticket_customer',
                        'mailbox_admin',
                        'mailbox_customer',
                        'admin_dashboard',
                        'customer_dashboard']));
                $user = $interface->execute(['slug' => $slug]);
                return ['user' => $user, 'uniqueModuleName' => $uniqueModuleName, 'permissions' => $permissions];
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return $response = array('abort' => '403', 'message' => 'You do not have access to this action!');
        }
    }


    public function update(UpdateUserRequest $request, $slug)
    {
        if (auth()->guard('web')->user()->can('edit.user_management')) {
            try {
                $response = (new UserUpdateAction())->execute($validatedData = $request->validated(), $slug);
                return redirect()->route('user.index')->with('success', 'User Updated Successfully');

            } catch (Exception $exception) {

                return $exception->getMessage();
            }
        } else {
            abort(403, 'You do not have access to edit user!');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $user = User::where('remember_token', $request->token)->firstOrFail();
            if ($user) {
                $response = (new UserUpdateAction())->execute($validatedData = $request->validated(), $user->slug);

                return redirect()->route('login')->with('success', 'Thanks! Password updated successfully');
            } else {
                throw new Exception('User Not Found');
            }
        } catch (Exception $exception) {
            return redirect()->back('302');
        }
    }

    public function deleteBulkUser(Request $request)
    {

        if (auth()->guard('web')->user()->can('delete.user_management')) {
            $response = (new UserBulkDeleteAction())->execute($request['user_checkbox']);
            return redirect()->route('user.index')->with('success', 'Users Deleted Successfully');
        } else {
            abort(403, 'You do not have access to delete!');
//            return $response  = array('abort' => '403','message'=> 'Oops! You do not have sufficient permission to delete.');
        }

    }

    public function destroy($slug)
    {
        if (auth()->guard('web')->user()->can('delete.user_management')) {
            try {
                $responseArray=array();
                $response = (new UserDestroyAction())->execute($slug);
//                if (\request()->ajax()) {

                    if ($response == '405') {
                        $responseArray = array('success' => '0', 'message' => 'Logged in user cannot be deleted ');
                    } elseif ($response == '406') {
                        $responseArray = array('success' => '0', 'message' => 'Super Admin account cannot be deleted');
                    }else{
                        $responseArray = array('success' => '1', 'message' => 'User Deleted Successfully');
                    }
//                }
                return request()->wantsJson() ? response()->json($responseArray) : redirect()->route('user.index')->with('success', 'User Deleted Successfully');

            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            if (\request()->ajax()) {
                return $response = array('abort' => '403', 'message' => 'You do not have access to delete!');
            } else {
                abort(403, 'You do not have access to delete!');
            }

        }
    }


    public function showSetPasswordForm($token)
    {
//        $response=(new ShowResetPasswordFormAction())->execute($token);
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        return view('auth.passwords.updatePassword', ['token' => $token, 'login_bg_image' => $login_bg_image['value']]);
    }


    public function filterByName($orderBy)
    {
        $response = (new UserFilterByNameAction())->execute($orderBy, config('paginate.page_count'));
        return response()->json($response);

    }
}
