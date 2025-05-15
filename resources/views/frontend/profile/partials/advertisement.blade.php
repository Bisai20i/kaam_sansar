@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<div id="Advertisement" class="profile-section">
  <div class="card-container-jobs border advertisement">
    <div class="row g-4 p-3 row-cols-1 row-cols-md-2 row-cols-lg-3" id="profile-advertisement-boxes">
      @foreach($ads as $ad)
      <div class="col">
        <div class="profile-advertisement-box p-2">
          <img alt="{{ $ad->adsTitle }}" src="{{ asset($ad->adsThumbnail) }}" />
          <h2 class="pt-2">{{ $ad->adsTitle }}</h2>
          <h3>{{ $ad->location }}</h3>

          <div class="flex">
            <p class="mt-1">{{ $ad->created_at->diffForHumans() }}</p>
            <div class="d-flex gap-1">
              <button class="edit mb-2 p-1 px-3"
                onclick="showEditForm(
  {{ $ad->id }},
  '{{ addslashes($ad->adsTitle) }}',
  '{{ addslashes($ad->pricing) }}',
  '{{ addslashes($ad->adsDescription) }}',
  '{{ addslashes($ad->country) }}',
  '{{ addslashes($ad->location) }}',
  '{{ addslashes($ad->contactNumber) }}',
  '{{ $ad->adsCategoryId }}',
  '{{ $ad->type }}',
  '{{ asset($ad->adsThumbnail) }}'
)">Edit</button>

              <button type="button" class="delete mb-2 p-1 px-3" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ad->id }}">
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal{{ $ad->id }}" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this advertisement?</div>
            <div class="modal-footer">
              <form action="{{ route('ads.destroy', $ad->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Edit Form -->
    <div class="container-box-edit-advertisement p-3" id="edit-advertisement" style="display: none;">
      <h2 class="my-2">Edit Advertisement</h2>

      <form id="editForm" method="POST" enctype="multipart/form-data" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="ad_id" id="ad-id">

        <!-- Type Dropdown -->
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-select py-2" name="type" id="type">
            <option value="Buy">Buy</option>
            <option value="Sell">Sell</option>
            <option value="Rent">Rent</option>
          </select>
        </div>

        <!-- Category -->
        <div class="form-group">
          <label for="category">Category</label>
          <select id="category" name="adsCategoryId" class="form-select rounded-pill">
            @foreach($adsCategory as $categoryItem)
            <option value="{{ $categoryItem->id }}">{{ $categoryItem->adsCategoryTitle }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" class="form-control my-2" name="country" id="country">
        </div>

        <div class="form-group">
          <label>City</label>
          <input type="text" class="form-control" name="location" id="location">
        </div>

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control my-2" name="adsTitle" id="title">
        </div>

        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control my-2" name="pricing" id="price">
        </div>

        <div class="form-group">
          <label>Contact No</label>
          <input type="tel" class="form-control" name="contactNumber" id="contactNumber" required>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control my-2" name="adsDescription" id="description" rows="4"></textarea>
        </div>

        <!-- Image Upload -->
        <div class="d-flex flex-column p-2 gap-2 mt-3">
          <div class="d-flex align-items-center gap-3">
            <label for="image">Image</label>
            <div class="d-flex align-items-center gap-2">
              <label for="fileInput" style="cursor: pointer;">
                <i class="fa-solid fa-image fa-lg"></i>
              </label>
              <input type="file" id="fileInput" name="adsThumbnail" accept="image/*" class="d-none">
            </div>
          </div>

          <div class="mt-2" id="currentImageContainer">
            <p class="mb-1">Current Image:</p>
            <img id="currentImage" style="height: 60px; border-radius: 6px;" alt="Current Image">
          </div>

          <div id="imagePreviewContainer" class="d-none mt-1">
            <p class="mb-1">Selected Image:</p>
            <img id="imagePreview" class="img-fluid" style="height: 60px; border-radius: 6px;" alt="Selected Image">
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  function showEditForm(id, title, price, description, country, location, contactNumber, categoryId, type, imageUrl) {
    document.getElementById('ad-id').value = id;
    document.getElementById('title').value = title;
    document.getElementById('price').value = price;
    document.getElementById('description').value = description;
    document.getElementById('country').value = country;
    document.getElementById('location').value = location;
    document.getElementById('contactNumber').value = contactNumber;
    document.getElementById('category').value = categoryId;
    document.getElementById('type').value = type;
    document.getElementById('currentImage').src = imageUrl;

    const form = document.getElementById('editForm');
    form.action = `/ads/${id}`;

    document.getElementById('edit-advertisement').style.display = 'block';
    document.getElementById('profile-advertisement-boxes').style.display = 'none';
  }

  function hideEditForm() {
    document.getElementById('edit-advertisement').style.display = 'none';
    document.getElementById('profile-advertisement-boxes').style.display = 'flex';
  }

  document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const currentImageContainer = document.getElementById('currentImageContainer');

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        previewContainer.classList.remove('d-none');
        if (currentImageContainer) currentImageContainer.classList.add('d-none');
      };
      reader.readAsDataURL(file);
    } else {
      previewContainer.classList.add('d-none');
    }
  });
</script>

@endsection