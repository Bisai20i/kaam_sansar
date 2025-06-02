@extends('backend.layouts.main')

@section('title', 'Document Subtypes')

@section('content')
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                            <h4 class="fw-bold m-0">
                                {{ isset($documentSubtype) ? 'Edit Document Subtype' : 'Create Document Subtype' }}
                            </h4>
                            <a href="{{ route('document-subtypes.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>

                        <div class="main-content">
                            <section class="section">
                                <form id="formAuthentication" class="mb-3" novalidate
                                    action="{{ isset($documentSubtype) ? route('document-subtypes.update', $documentSubtype->id) : route('document-subtypes.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($documentSubtype))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="documentSubtype" class="form-label">Document Subtype <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('documentSubtype') ? ' is-invalid' : '' }}"
                                                id="documentSubtype" name="documentSubtype" placeholder="Enter document subtype"
                                                value="{{ old('documentSubtype', isset($documentSubtype) ? $documentSubtype->documentSubtype : '') }}"
                                                autofocus required />
                                            @error('documentSubtype')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                        id="submitButton">
                                        <span id="buttonText">{{ isset($documentSubtype) ? 'Update' : 'Create' }}</span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Form submission loader
            const form = document.getElementById('formAuthentication');
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loaderSpinner = document.getElementById('loaderSpinner');

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                loaderSpinner.classList.remove('d-none');
                buttonText.style.display = 'none';
            });

            // Bootstrap validation
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    const form = document.getElementById('formAuthentication');
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                }, false);
            })();
        });
    </script>
@endsection