<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationService extends Model
{
    protected $mailer;
    protected $activationRepo;
    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo) {
    	$this->mailer = $mailer;
    	$this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user) {
    	if($user->activated || !$this->shouldSend($user)) {
    		return;
    	}

    	$token = $this->activationRepo->createActivation($user);
    	$link = route('user.activate', $token);

    	$data = [
    		'link' => $link,
    		'name' => $user->name
    	];
    	$this->mailer->send(['html' => 'email.template'], $data, function(Message $m) use ($user) {
    		$m->to($user->email)->subject('Activation mail');
    	});
    }

    public function activateUser($token) {
    	$activation = $this->activationRepo->getActivationByToken($token);
    	if($activation === null) {
    		return null;
    	}

    	$user = User::find($activation->user_id);
    	$user->activated = true;
    	$user->save();
    	$this->activationRepo->deleteActivation($token);
    	return $user;
    }

    private function shouldSend($user) {
    	$activation = $this->activationRepo->getActivation($user);
    	return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}
