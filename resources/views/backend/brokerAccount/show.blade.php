@extends('frontend.layouts.main')

@section('title', 'Broker Account Details')

@section('content')

<section class="prform mt-4">
    <div class="container-fluid container-lg">
        <div id="form-container" class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">
            <!-- Broker Account View -->
            <div id="brokerAccountView">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Broker Account Details</h3>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="attestation">
                        <div class="">
                            <h4 class="py-1 border-bottom border-2 border-primary d-inline-block">Depository Details</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">BOID:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->boid ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Account Information</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">Referral Code:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->referral_code ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Client Type:</label>
                                <div class="form-control-static fs-6">{{ ucfirst($brokerAccount->client_type) ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Mobile Number:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->mobile_number ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Branch Name:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->branch_name ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">PAN Number:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->pan_number ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Email Address:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->email_address ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">WhatsApp Number:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->whatsapp_number ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Viber Number:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->viber_number ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Facebook Link:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->facebook_link ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Bank Details</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">Bank Name:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->bank_name ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Bank Branch:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->bank_branch ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Account Type:</label>
                                <div class="form-control-static fs-6">{{ ucfirst($brokerAccount->account_type) ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Account Number:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->account_number ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Investment Information Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Investment Information</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">Investment Source:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->investment_source ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Company Name:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->company_name ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Job/Business Years:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->job_business_years ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Investment Amount (NPR):</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->investment_amount ? number_format($brokerAccount->investment_amount, 2) : 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6 d-block">Trading Knowledge:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->trading_knowledge ? 'Yes' : 'No' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Permanent Address Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Permanent Address</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">Country:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_country ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Province:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_province ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">District:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_district ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Municipality:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_municipality ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Ward No:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_ward ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">City:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_city ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Tole:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_tole ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Street:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_street ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">House No:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->permanent_house_no ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Temporary Address Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Temporary Address</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">Country:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_country ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Province:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_province ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">District:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_district ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Municipality:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_municipality ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Ward No:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_ward ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">City:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_city ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Tole:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_tole ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Street:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_street ?? 'N/A' }}</div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">House No:</label>
                                <div class="form-control-static fs-6">{{ $brokerAccount->temporary_house_no ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="attestation">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Submitted Documents</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                            <div class="col">
                                <label class="form-label fs-6">KYC Form:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->kyc_form)
                                        <a href="{{ asset('storage/'.$brokerAccount->kyc_form) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Citizenship Certificate:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->citizen_certificate)
                                        <a href="{{ asset('storage/'.$brokerAccount->citizen_certificate) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Birth Certificate:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->birth_certificate)
                                        <a href="{{ asset('storage/'.$brokerAccount->birth_certificate) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Visa/Passport:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->visa_passport)
                                        <a href="{{ asset('storage/'.$brokerAccount->visa_passport) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Selfie with ID:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->selfie_with_id)
                                        <a href="{{ asset('storage/'.$brokerAccount->selfie_with_id) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Guardian Citizenship:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->guardian_citizenship)
                                        <a href="{{ asset('storage/'.$brokerAccount->guardian_citizenship) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Passport Size Photo:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->pp_size_photo)
                                        <a href="{{ asset('storage/'.$brokerAccount->pp_size_photo) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">Trading Agreement:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->trading_agreement)
                                        <a href="{{ asset('storage/'.$brokerAccount->trading_agreement) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fs-6">ID Card:</label>
                                <div class="form-control-static fs-6">
                                    @if($brokerAccount->id_card)
                                        <a href="{{ asset('storage/'.$brokerAccount->id_card) }}" target="_blank">View Document</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between py-4">
                        <div class="text-muted">
                            Submitted on: {{ $brokerAccount->created_at->format('Y-m-d H:i:s') }}
                        </div>
                        <div class="text-muted">
                            Application ID: {{ $brokerAccount->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-control-static {
        padding: 0.375rem 0.75rem;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        min-height: 38px;
        background-color: #f8f9fa;
    }
</style>

@endsection