<div id="training" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Trainings/Certification</h4>
    <div class="card p-3">
        <form id="trainingForm" enctype="multipart/form-data">
            @csrf
            <h3>Certification</h3>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="training-title" class="form-label">Training/Certification
                        Title</label>
                    <input type="text" class="form-control custom-input" name="trainingTitle"
                        id="training-title" placeholder="" required>

                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-organization"
                        class="form-label">Institution/Organization</label>
                    <input type="text" class="form-control custom-input" name="institutionName"
                        id="training-organization" placeholder="" required>

                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-date" class="form-label">Completion Date</label>
                    <input type="date" class="form-control custom-input" name="completionDate"
                        id="training-date" placeholder="" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-flex align-items-center gap-3">
                    <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Training certificate</p>

                    <!-- Image upload trigger -->
                    <div class="d-flex align-items-center gap-2">
                        <label for="certificate" class="primary_color_text m-0" style="cursor: pointer;">
                            <i class="fa-solid fa-image fa-lg"></i>
                        </label>
                        <input type="file" id="certificate" accept="image/*" class="d-none form-control custom-input" name="certificate">
                    </div>
                </div>
                <!-- Image Preview (small) -->
                <div id="imgPreview" class="d-flex mt-1" style="height: 80px;"></div>
            </div>
            <script>
                const certificate = document.getElementById('certificate');
                const imgPreview = document.getElementById('imgPreview');

                certificate.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imgPreview.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview" style="height: 100%; width: 30%; border-radius: 6px; object-fit: cover;">
                                    `;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imgPreview.innerHTML = '';
                    }
                });
            </script>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addTraining">
                    + Add Training
                </button>
                <div class="text-end">
                    <button type="submit" class="btn text-center skip-btn mx-2" data-current="training" data-next="language" data-link="languageLink">Skip</button>
                    <button type="button" class="btn text-center next-btn" id="submitTraining">Save & Continue</button>
                </div>
            </div>

        </form>
    </div>
    <div class="container mt-4 p-0">
        <div id="trainingList"></div>
        @if($trainings->isNotEmpty())
        @foreach($trainings as $training)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>{{ $training->trainingTitle }}</h5>
                </div>
                <div>
                    <a href="{{ route('trainings.edit', $training->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger fw-semibold">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">
                    {{ $training->institutionName }}
                </p>
                <p class="m-0">
                    {{ \Carbon\Carbon::parse($training->completionDate)->format('M Y') }}
                </p>
                @if($training->certificate)
                <p class="m-0">
                    <a href="{{ asset($training->certificate) }}" target="_blank">
                        View certificate </a>
                </p>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {


        function collectTrainingData() {
            const formData = new FormData();
            formData.append('trainingTitle', document.getElementsByName('trainingTitle')[0].value);
            formData.append('institutionName', document.getElementsByName('institutionName')[0].value);
            formData.append('completionDate', document.getElementsByName('completionDate')[0].value);
            const certificateFile = document.getElementsByName('certificate')[0].files[0];
            if (certificateFile) {
                formData.append('certificate', certificateFile);
            }
            return formData;
        }

        async function saveTrainingData(trainingData) {
            try {
                const response = await fetch("{{ route('trainings.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: trainingData
                });
                return await response.json();
            } catch (error) {
                console.error("Error saving training data:", error);
                return {
                    success: false
                };
            }
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = {
                year: 'numeric',
                month: 'short'
            };
            return date.toLocaleDateString('en-US', options);
        }

        function appendTrainingCard(training) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>${training.trainingTitle}</h5>
                        </div>
                        <div>
                            <a href="/trainings/${training.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                            <form action="/trainings/${training.id}" method="POST" style="display:inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-black-50">
                        <p class="m-0">${training.institutionName}</p>
                        <p class="m-0">Completed on: ${formatDate(training.completionDate)}</p>
                        ${training.certificate ? `<img src="${training.certificate}" ...>` : ''}
                    </div>
                `;
            document.getElementById('trainingList').appendChild(card); // Make sure this element exists in your HTML
        }

        // Prevent form submission
        document.getElementById('trainingForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        document.getElementById('addTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const trainingData = collectTrainingData();
            const result = await saveTrainingData(trainingData);
            if (result.success) {
                document.getElementById('trainingForm').reset();
                document.getElementById('imgPreview').innerHTML = '';
                appendTrainingCard(result.training);
            }
        });

        document.getElementById('submitTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const trainingData = collectTrainingData();
            const result = await saveTrainingData(trainingData);
            if (result.success) {
                appendTrainingCard(result.training);
                document.getElementById('training').style.display = 'none';
                document.getElementById('language').style.display = 'block';
                document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                document.getElementById('languageLink').classList.add('active');
            }
        });
    })
</script>
@endpush