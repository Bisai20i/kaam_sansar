<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Broker Account Details</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      line-height: 1.6;
      background: #f5f5f5;
      padding: 20px;
    }
    .form-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .form-header h3 {
      color: #0064a7;
    }
    .form-section {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #0064a7;
    }
    .form-section h4 {
      color: #0064a7;
      margin-bottom: 15px;
    }
    .form-row {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -10px 15px;
    }
    .form-group {
      flex: 0 0 33.33%;
      padding: 0 10px;
      margin-bottom: 15px;
    }
    .form-label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
    }
    .form-value {
      display: block;
      width: 100%;
      padding: 8px 12px;
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      border-radius: 4px;
      min-height: 38px;
    }
    @media (max-width: 992px) {
      .form-group { flex: 0 0 50%; }
    }
    @media (max-width: 768px) {
      .form-group { flex: 0 0 100%; }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-header">
      <h3>Broker Account Details</h3>
    </div>

    <!-- Depository Details -->
    <div class="form-section">
      <h4>Depository Details</h4>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">BOID</label>
          <div class="form-value">{{ $brokerAccount->boid }}</div>
        </div>
      </div>
    </div>

    <!-- Account Information -->
    <div class="form-section">
      <h4>Account Information</h4>
      <div class="form-row">
        @foreach([
          'Referral Code'   => $brokerAccount->referralCode,
          'Client Type'     => ucfirst($brokerAccount->clientType),
          'Mobile Number'   => $brokerAccount->mobileNumber,
          'Branch Name'     => $brokerAccount->branchName,
          'PAN Number'      => $brokerAccount->panNumber,
          'Email Address'   => $brokerAccount->emailAddress,
          'WhatsApp Number' => $brokerAccount->whatsappNumber,
          'Viber Number'    => $brokerAccount->viberNumber,
          'Facebook Link'   => $brokerAccount->facebookLink,
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Bank Details -->
    <div class="form-section">
      <h4>Bank Details</h4>
      <div class="form-row">
        @foreach([
          'Bank Name'      => $brokerAccount->bankName,
          'Bank Branch'    => $brokerAccount->bankBranch,
          'Account Type'   => ucfirst($brokerAccount->accountType),
          'Account Number' => $brokerAccount->accountNumber,
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Investment Information -->
    <div class="form-section">
      <h4>Investment Information</h4>
      <div class="form-row">
        @foreach([
          'Investment Source' => $brokerAccount->investmentSource,
          'Company Name'      => $brokerAccount->companyName,
          'Job/Business Years'=> $brokerAccount->jobBusinessYears,
          'Investment Amount' => $brokerAccount->investmentAmount 
                                 ? 'Rs. '.number_format($brokerAccount->investmentAmount,2) 
                                 : null,
          'Trading Knowledge' => $brokerAccount->tradingKnowledge ? 'Yes' : 'No',
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Permanent Address -->
    <div class="form-section">
      <h4>Permanent Address</h4>
      <div class="form-row">
        @foreach([
          'Country'      => $brokerAccount->permanentCountry,
          'Province'     => $brokerAccount->permanentProvince,
          'District'     => $brokerAccount->permanentDistrict,
          'Municipality' => $brokerAccount->permanentMunicipality,
          'Ward No'      => $brokerAccount->permanentWard,
          'City'         => $brokerAccount->permanentCity,
          'Tole'         => $brokerAccount->permanentTole,
          'Street'       => $brokerAccount->permanentStreet,
          'House No'     => $brokerAccount->permanentHouseNo,
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Temporary Address -->
    @unless($brokerAccount->sameAsPermanent)
    <div class="form-section">
      <h4>Temporary Address</h4>
      <div class="form-row">
        @foreach([
          'Country'      => $brokerAccount->temporaryCountry,
          'Province'     => $brokerAccount->temporaryProvince,
          'District'     => $brokerAccount->temporaryDistrict,
          'Municipality' => $brokerAccount->temporaryMunicipality,
          'Ward No'      => $brokerAccount->temporaryWard,
          'City'         => $brokerAccount->temporaryCity,
          'Tole'         => $brokerAccount->temporaryTole,
          'Street'       => $brokerAccount->temporaryStreet,
          'State'        => $brokerAccount->temporaryState,
          'House No'     => $brokerAccount->temporaryHouseNo,
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>
    @endunless

    <!-- Documents & Status -->
    <div class="form-section">
      <h4>Documents & Status</h4>
      <div class="form-row">
        @foreach([
          'KYC Form'             => $brokerAccount->kycForm,
          'Citizenship Cert.'    => $brokerAccount->citizenCertificate,
          'Birth Certificate'    => $brokerAccount->birthCertificate,
          'Visa/Passport'        => $brokerAccount->visaPassport,
          'Selfie with ID'       => $brokerAccount->selfieWithId,
          'Guardian Citizenship' => $brokerAccount->guardianCitizenship,
          'PP Size Photo'        => $brokerAccount->ppSizePhoto,
          'Trading Agreement'    => $brokerAccount->tradingAgreement,
          'ID Card'              => $brokerAccount->idCard,
          'Status'               => ucfirst($brokerAccount->status),
          'Payment'              => ucfirst($brokerAccount->payment),
        ] as $label => $value)
          <div class="form-group">
            <label class="form-label">{{ $label }}</label>
            <div class="form-value">{{ $value ?? 'N/A' }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>