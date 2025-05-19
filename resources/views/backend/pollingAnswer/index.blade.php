@extends('backend.layouts.main')
@section('title', 'Manage Polling Questions')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4">Polling Answer</h4>

    <!-- Add Answer Form -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">Add New Polling Answers</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pollingAnswers.store') }}" id="pollAnswerForm">
                        @csrf
                        <div class="mb-3">
                            <label>Select Question</label>
                            <select name="polling_question_id" class="form-select" required>
                                <option value="">-- Select question --</option>
                                @foreach($pollingQuestions as $pollingQuestion)
                                <option value="{{ $pollingQuestion->id }}">{{ $pollingQuestion->question }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="answerInputs">
                            <div class="input-group mb-2">
                                <input type="text" name="answers[]" class="form-control" placeholder="Enter answer" required>
                                <button type="button" class="btn btn-danger remove-btn">Remove</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="addAnswerBtn">+ Answer</button>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit All Answers</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Answers Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Polling Answers List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pollingAnswers as $answer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $answer->question->question ??'' }}</td>
                                    <td>{{ $answer->answer }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-btn" 
                                                data-id="{{ $answer->id }}"
                                                data-answer="{{ $answer->answer }}"
                                                data-question-id="{{ $answer->polling_question_id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" 
                                                data-id="{{ $answer->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Answer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Question</label>
                        <select name="polling_question_id" class="form-select" required>
                            @foreach($pollingQuestions as $pollingQuestion)
                            <option value="{{ $pollingQuestion->id }}">{{ $pollingQuestion->question }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Answer</label>
                        <input type="text" name="answer" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this answer?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add/Remove answer fields
        const answerContainer = document.getElementById('answerInputs');
        const addAnswerBtn = document.getElementById('addAnswerBtn');
        
        addAnswerBtn.addEventListener('click', function() {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2';
            
            inputGroup.innerHTML = `
                <input type="text" name="answers[]" class="form-control" placeholder="Enter answer" required>
                <button type="button" class="btn btn-danger remove-btn">Remove</button>
            `;
            
            answerContainer.appendChild(inputGroup);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-btn')) {
                e.target.closest('.input-group').remove();
            }
        });

        // Edit Modal
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        const editForm = document.getElementById('editForm');
        
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const answer = this.getAttribute('data-answer');
                const questionId = this.getAttribute('data-question-id');
                
                editForm.action = `/superadmin/pollingAnswers/${id}`;
                editForm.querySelector('[name="answer"]').value = answer;
                editForm.querySelector('[name="polling_question_id"]').value = questionId;
                
                editModal.show();
            });
        });

        // Delete Modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                deleteForm.action = `/superadmin/pollingAnswers/${id}`; 
                deleteModal.show();
            });
        });
    });
</script>
@endpush