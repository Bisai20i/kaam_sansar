@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        .company-list-item {
            cursor: pointer;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            margin-top: -1px;
        }

        .company-list-item:hover {
            background-color: #e7f1ff;
        }

        .company-list-item.active {
            background-color: #ffffff;
            color: #007bff;
        }

        .highlight {
            background-color: #cfe2ff;
            padding: 0 2px;
        }

        .not-found {
            padding: 8px 12px;
            color: #6c757d;
            background-color: #f8f9fa;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        .scroll-list {
            max-height: 144px;
            overflow-y: auto;
        }
    </style>

    <div class="container py-5">
        <!-- Basic Bootstrap Table -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                            <h4 class="fw-bold m-0">
                                {{ isset($faq) ? 'Edit FAQ' : 'Create FAQ' }}
                            </h4>
                            <a href="{{ route('faqs.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>

                        <!-- Main Content -->
                        <div class="main-content">
                            <section class="section">
                                <form id="formAuthentication" class="mb-3" novalidate
                                    action="{{ isset($faq) ? route('faqs.update', $faq->id) : route('faqs.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($faq))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="question" class="form-label">Question <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                                id="question" name="question" placeholder="Enter your question"
                                                value="{{ old('question', isset($faq) ? $faq->question : '') }}"
                                                autofocus required />
                                            @error('question')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label for="answer" class="form-label">Answer <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" id="answer"
                                                name="answer" rows="5" required>{{ old('answer', isset($faq) ? $faq->answer : '') }}</textarea>
                                            @error('answer')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                        id="submitButton">
                                        <span id="buttonText">{{ isset($faq) ? 'Update' : 'Create FAQ' }}</span>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#answer').summernote({
                placeholder: 'Write your answer here...',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

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

            // Additional validation for Summernote content
            $('#formAuthentication').on('submit', function() {
                const answerContent = $('#answer').summernote('code').replace(/<[^>]*>/g, '').trim();
                if (answerContent === '') {
                    $('#answer').addClass('is-invalid');
                    $('<div class="invalid-feedback">The answer field is required.</div>').insertAfter('#answer');
                    return false;
                }
                return true;
            });

            // Clear validation on Summernote change
            $('#answer').on('summernote.change', function() {
                const answerContent = $('#answer').summernote('code').replace(/<[^>]*>/g, '').trim();
                if (answerContent !== '') {
                    $('#answer').removeClass('is-invalid');
                    $('#answer').next('.invalid-feedback').remove();
                }
            });
        });
    </script>
@endsection