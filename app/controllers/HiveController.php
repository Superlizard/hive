<?php

class HiveController extends BaseController {

	public function getIndex() {   
		return View::make('site/hive');
	}

	public function getNavbar() {
		if(Sentry::check()) {
			$user = Sentry::getUser(); 
			return View::make('hive/navbar', compact('user'));  
		} 
	}

	public function getContent() {
		if(Sentry::check()) {
			$user = Sentry::getUser(); 

			return array(
				'view' => View::make('hive/content', compact('user'))->render(), 
				'status' => 'logged-in'
			); 			
		} 

		return array(
			'view' => View::make('hive/login')->render(), 
			'status' => 'logged-out'
		); 
	}	

	public function getBottom() {
		if(Sentry::check()) {
			return View::make('hive/bottom'); 
		} 
	}		

	public function getFavorites() {
		if(Sentry::check()) {
			return array(
				'view' => View::make('hive/favorites')->render(),
				'status' => 'logged-in'
			);  
		} 
	}

	public function getSettings() {
		if(Sentry::check()) {
			return array(
				'view' => View::make('hive/settings')->render(),
				'status' => 'logged-in'
			);   
		} 
	}	

	public function postLogin() {
		try {
            $credentials = array(
                'email'    => Input::get('email') ?: null,
                'password' => Input::get('password') ?: null
            );

            $user = Sentry::authenticate($credentials, Input::get('remember_me') ?: false);

			return array(
				'content' => View::make('hive/content', compact('user'))->render(), 
				'navbar' => View::make('hive/navbar', compact('user'))->render(),
				'bottom' => View::make('hive/bottom')->render(),
				'status' => 'logged-in'
			);             
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
        	$message = "Du måste fylla i dina uppgifter."; 
		    return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
			$message = "Du glömde ditt lösenord."; 
			return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			$message = "Fel lösenord."; 
			return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$message = "Användaren existerar inte."; 
			return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			$message = "Användaren är inte aktiverad."; 
			return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			$message = "Användaren är temporärt bannad."; 
			return View::make('hive/login', compact('message'));
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			$message = "Banhammer in yo&#39; face m8!"; 
			return View::make('hive/login', compact('message'));
		}
	}

	public function getLogout() {
		if(Sentry::check()) {
			Sentry::logout();

			return array(
				'status' => 'logged-out'
			);   
		}	
	}
}