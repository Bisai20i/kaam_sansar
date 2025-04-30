<div id="visa" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Visa</h4>
    <div class="card p-3 card-center">
        <form id="visaForm" enctype="multipart/form-data">
            @csrf
            <h3>Visa Details</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="first-name" class="form-label">Visa Details</label>
                    <input type="text" class="form-control custom-input" name="visaDetails" id="first-name"
                        placeholder="California University" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Visa Expiry <span
                            class="">*</span></label>
                    <input type="date" class="form-control custom-input" name="visaExpire" id="date"
                        placeholder="Bachelor" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Country" class="form-label">Country <span
                            class="">*</span></label>
                    <input type="text" class="form-control custom-input" name="country" id="Country"
                        placeholder="Pokhara" required />
                </div>
                <!-- Top row -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Visa Photo</p>

                        <!-- Image upload trigger -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="fileInput" class="primary_color_text m-0" style="cursor: pointer;">
                                <i class="fa-solid fa-image fa-lg"></i>
                            </label>
                            <input type="file" id="fileInput" accept="image/*" class="form-control  d-none custom-input" name="visaImage" required />
                        </div>
                    </div>
                    <!-- Image Preview (small) -->
                    <div id="imagePreview" class="d-flex mt-1" style="height: 80px;"></div>
                </div>
            </div>

            <script>
                const fileInput = document.getElementById('fileInput');
                const imagePreview = document.getElementById('imagePreview');

                fileInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = `
                                                    <img src="${e.target.result}" alt="Preview" style="height: 100%; width:30%; border-radius: 6px; object-fit: cover;">
                                                    `;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.innerHTML = '';
                    }
                });
            </script>
            <div class="text-end ">
                <button type="submit" class="btn text-center skip-btn mx-2" data-current="visa" data-next="education" data-link="educationLink">Skip</button>
                <button type="submit" class="btn text-center next-btn">Save & Continue</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('visaForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            console.log('Form Submitted'); // Add this line for debugging

            fetch("{{ route('visas.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log(response);
                    return response.json(); // This might throw the error
                })
                .then(data => {
                    console.log(data); // Log the JSON data here
                    if (data.success) {
                        document.getElementById('visa').style.display = 'none';
                        document.getElementById('education').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('educationLink').classList.add('active');
                    } else {
                        alert("Error saving profile.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    })
</script>
@endpush