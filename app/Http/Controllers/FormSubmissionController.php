<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    public function index(){

        $forms = FormSubmission::where('job_seeker_id', Auth::guard('job_seekers')->user()->id)->get();

        $forms->transform(function($form){

            switch($form->title){
                case 'Passport Renewal':
                    
                    $model_name = 'PassportRenewal';
                    break;
                case 'Work Permit':
                    $model_name = 'WorkPermit';
                    break;
                case 'Document Attestation':
                    $model_name = 'DocumentAttestation';
                    break;
                case 'Bank Account':
                    $model_name = 'BankAccount';
                    break;
                case 'Broker_Account':
                    $model_name = 'BrokerAccount';
                    break;
                default:
                    $model_name = null;
                    break;
            }
            $modelClass = "App\\Models\\$model_name";
            
            $form->status = $modelClass::where('id', $form->form_id)->first()->status;

            return $form;
            
        });

        // return $forms;
        return view('frontend.profile.partials.my-forms', compact('forms'));
    }

    public function findForm($id){

        $form = FormSubmission::where('id', $id)->first();
        switch($form->title){
                case 'Passport Renewal':
                    
                    $route_name = 'passport.edit';
                    break;
                case 'Work Permit':
                    $route_name = 'workPermits.edit';
                    break;
                case 'Document Attestation':
                    $route_name = 'documentAttestations.edit';
                    break;
                case 'Bank Account':
                    $route_name = 'bankAccounts.edit';
                    break;
                case 'Broker_Account':
                    $route_name = 'brokerAccounts.edit';
                    break;
                default:
                    $route_name = null;
                    break;
            }
        
            // return $route_name;

        return redirect()->route($route_name, ['id' => $form->form_id]);
    }
}
