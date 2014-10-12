<?php

class QuantumTimeController extends BaseController {

	public function getIndex() {   
		if(Sentry::check()) {
			$entries = Entry::all(); 

			return View::make('quantumtime/index', compact('entries'));
		}
		
		return Redirect::to('quantum/login'); 
	}

	public function getCreate() {

	}

	public function getLogin() {
		if(Sentry::check()) {
			return Redirect::to('quantum'); 
		}

		return View::make('quantumtime/login'); 
	}

	public function postLogin() {
		try {
            $credentials = array(
                'email'    => Input::get('email') ?: null,
                'password' => Input::get('password') ?: null
            );

            $user = Sentry::authenticate($credentials, Input::get('remember_me') ?: false);

            return Redirect::intended('quantum');
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
		    return Redirect::to('quantum/login')->with('error', 'Login credentials are required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
			return Redirect::to('quantum/login')->with('error', 'Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			return Redirect::to('quantum/login')->with('error', 'Wrong password, try again.');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			return Redirect::to('quantum/login')->with('error', 'That particular user doesn&#39;t exist in this universe.');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			return Redirect::to('quantum/login')->with('error', 'Scotty, why is this user not activated!?');
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			return Redirect::to('quantum/login')->with('error', 'User is suspended.');
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			return Redirect::to('quantum/login')->with('error', 'Banhammer in yo&#39; face m8!');
		}
	}

	public function getLogout() {
		if(Sentry::check()) {
			Sentry::logout();
			return Redirect::to('quantum/login'); 
		}	
	}
}