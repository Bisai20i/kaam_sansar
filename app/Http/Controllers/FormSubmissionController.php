<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    public function index()
    {
        $forms = FormSubmission::where('job_seeker_id', Auth::guard('job_seekers')->user()->id)->get();

        $forms = $forms->transform(function ($form) {
            switch ($form->title) {
                case 'Passport Renewal':
                    $model_name = 'PassportRenewal';
                    break;
                case 'Work Permit':
                    $model_name = 'WorkPermit';
                    break;
                case 'Document Attestation':
                    $model_name = 'DocumentationAttestation';
                    break;
                case 'Bank Account':
                    $model_name = 'BankAccount';
                    break;
                case 'Broker Account':
                    $model_name = 'BrokerAccount';
                    break;
                default:
                    return null; 
            }
            $modelClass = "App\\Models\\$model_name";
            $modelInstance = $modelClass::find($form->form_id);

            if (!$modelInstance) {
                $form->delete();
                return null;
            }

            $form->status = $modelInstance->status;
            return $form;
        })->filter();

        return view('frontend.profile.partials.my-forms', compact('forms'));
    }

    public function findForm($id)
    {

        $form = FormSubmission::where('id', $id)->first();
        switch ($form->title) {
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
            case 'Broker Account':
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
