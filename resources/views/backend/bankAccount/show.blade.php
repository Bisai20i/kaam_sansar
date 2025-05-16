<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bank Account Application</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }
        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
            .form-group {
                flex: 0 0 50%;
            }
        }
        @media (max-width: 768px) {
            .form-group {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <h3>Account Opening Form</h3>
    </div>

    <form id="bankAccountForm">
        <!-- Applicant Type Section -->
        <div class="form-section">
            <h4>Applicant Type</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Applicant Type:</label>
                    <div class="form-value">{{ $bankAccount->applicantType ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Salutation:</label>
                    <div class="form-value">{{ $bankAccount->salutation ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nepali Citizen:</label>
                    <div class="form-value">{{ $bankAccount->nepaleseCitizen ? 'Yes' : 'No' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Applicant Purpose:</label>
                    <div class="form-value">{{ $bankAccount->applicantPurpose ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Preferred Bank:</label>
                    <div class="form-value">{{ $bankAccount->preferredBank ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Branch:</label>
                    <div class="form-value">{{ $bankAccount->branch ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Personal Details Section -->
        <div class="form-section">
            <h4>Personal Details</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">First Name:</label>
                    <div class="form-value">{{ $bankAccount->firstName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Middle Name:</label>
                    <div class="form-value">{{ $bankAccount->middleName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Last Name:</label>
                    <div class="form-value">{{ $bankAccount->lastName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile Number:</label>
                    <div class="form-value">{{ $bankAccount->mobileNumber ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number:</label>
                    <div class="form-value">{{ $bankAccount->phoneNumber ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address:</label>
                    <div class="form-value">{{ $bankAccount->email ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Date of Birth (BS):</label>
                    <div class="form-value">{{ $bankAccount->nepaliDob ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Date of Birth (AD):</label>
                    <div class="form-value">{{ $bankAccount->englishDob ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Apply From Country:</label>
                    <div class="form-value">{{ $bankAccount->applyFromCountry ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Contact Medium:</label>
                    <div class="form-value">{{ $bankAccount->contactMedium ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Other Contact Details:</label>
                    <div class="form-value">{{ $bankAccount->otherContactDetail ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Family Details Section -->
        <div class="form-section">
            <h4>Family Details</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Father's Name:</label>
                    <div class="form-value">{{ $bankAccount->fatherName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Mother's Name:</label>
                    <div class="form-value">{{ $bankAccount->motherName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Grandfather's Name:</label>
                    <div class="form-value">{{ $bankAccount->grandfatherName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Spouse Name:</label>
                    <div class="form-value">{{ $bankAccount->spouse ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Permanent Address Section -->
        <div class="form-section">
            <h4>Permanent Address</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Country:</label>
                    <div class="form-value">{{ $bankAccount->permanentCountry ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Province:</label>
                    <div class="form-value">{{ $bankAccount->permanentProvince ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">District:</label>
                    <div class="form-value">{{ $bankAccount->permanentDistrict ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Municipality:</label>
                    <div class="form-value">{{ $bankAccount->permanentMunicipality ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">City:</label>
                    <div class="form-value">{{ $bankAccount->permanentCity ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Ward No:</label>
                    <div class="form-value">{{ $bankAccount->permanentWardNo ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Street:</label>
                    <div class="form-value">{{ $bankAccount->permanentStreet ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">State:</label>
                    <div class="form-value">{{ $bankAccount->permanentState ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tole:</label>
                    <div class="form-value">{{ $bankAccount->permanentTole ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">House No:</label>
                    <div class="form-value">{{ $bankAccount->permanentHouseNo ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Temporary Address Section -->
        @if(!$bankAccount->sameAsPermanent)
        <div class="form-section">
            <h4>Temporary Address</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Country:</label>
                    <div class="form-value">{{ $bankAccount->temporaryCountry ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Province:</label>
                    <div class="form-value">{{ $bankAccount->temporaryProvince ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">District:</label>
                    <div class="form-value">{{ $bankAccount->temporaryDistrict ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Municipality:</label>
                    <div class="form-value">{{ $bankAccount->temporaryMunicipality ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">City:</label>
                    <div class="form-value">{{ $bankAccount->temporaryCity ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Ward No:</label>
                    <div class="form-value">{{ $bankAccount->temporaryWardNo ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Street:</label>
                    <div class="form-value">{{ $bankAccount->temporaryStreet ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">State:</label>
                    <div class="form-value">{{ $bankAccount->temporaryState ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tole:</label>
                    <div class="form-value">{{ $bankAccount->temporaryTole ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">House No:</label>
                    <div class="form-value">{{ $bankAccount->temporaryHouseNo ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Job Details Section -->
        <div class="form-section">
            <h4>Job Details</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Job Title:</label>
                    <div class="form-value">{{ $bankAccount->jobTitle ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Job City:</label>
                    <div class="form-value">{{ $bankAccount->jobCity ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Company Name:</label>
                    <div class="form-value">{{ $bankAccount->companyName ?? 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Yearly Salary:</label>
                    <div class="form-value">{{ $bankAccount->yearlySalary ? number_format($bankAccount->yearlySalary, 2) : 'N/A' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Monthly Salary:</label>
                    <div class="form-value">{{ $bankAccount->monthlySalary ? number_format($bankAccount->monthlySalary, 2) : 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Documents Section -->
        <div class="form-section">
            <h4>Required Documents</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Signature Photo:</label>
                    <div class="form-value">
                        @if($bankAccount->signature)
                        <img scr="{{ asset($bankAccount->signature) }}" height="150px" width="150px">
                        <a href="{{ asset($bankAccount->signature) }}" target="_blank">View Signature</a>
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Thumb Print Photo:</label>
                    <div class="form-value">
                        @if($bankAccount->fingerPrint)
                    <img scr="{{ asset($bankAccount->fingerPrint) }}" height="150px" width="150px">
                    <a href="{{ asset($bankAccount->fingerPrint) }}" target="_blank">View FingerPrint</a>
 
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>