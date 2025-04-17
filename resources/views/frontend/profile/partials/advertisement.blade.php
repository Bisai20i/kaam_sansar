@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<div id="Advertisement" class="profile-section">
    <div class="card-container-jobs border advertisement ">
      <div class="row g-4 p-3 row-cols-1 row-cols-md-2 row-cols-lg-3" id="profile-advertisement-boxes">
        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-3" onclick="showEditForm()">Edit</button>
                <button class="delete mb-2 p-1 px-3" onclick="deleteAdvertisement()">Delete</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-3" onclick="showEditForm()">Edit</button>
                <button class="delete mb-2 p-1 px-3" onclick="deleteAdvertisement()">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-3" onclick="showEditForm()">Edit</button>
                <button class="delete mb-2 p-1 px-3" onclick="deleteAdvertisement()">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-3" onclick="showEditForm()">Edit</button>
                <button class="delete mb-2 p-1 px-3" onclick="deleteAdvertisement()">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-3" onclick="showEditForm()">Edit</button>
                <button class="delete mb-2 p-1 px-3" onclick="deleteAdvertisement()">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class=" profile-advertisement-box p-2">
            <img alt="Teddy bear in a room" src="Images/teddy-bear.jpg" />
            <h2 class="pt-2">Room For Rent</h2>
            <h3>Kathmandu</h3>
            <div class="flex">
              <p class="mt-1">2 min ago</p>
              <div class="d-flex gap-1">
                <button class="edit mb-2 p-1 px-2"
                  onclick="document.getElementById('edit-advertisement').style.display = 'block'; document.getElementById('profile-abroad-boxes').style.display = 'none';">Edit</button>
                <button class="delete mb-2 p-1 px-2">Delete</button>
              </div>
            </div>
          </div>
        </div>



      </div>


      <div class="container-box-edit-advertisement p-3" id="edit-advertisement" style="display: none;">
        <h2 class="my-2">Edit Advertisement (Room For Rent)</h2>
        <form>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control my-2" id="category">
              <option>Rent</option>
            </select>
          </div>
          <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control my-2" id="country">
              <option>Nepal</option>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control my-2" id="title" value="Room For Rent in Kathmandu">
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control my-2" id="price" value="Rs 8,000/month">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control my-2" id="description"
              rows="4">Culpa odio dolor quam qui ad culpa eos dolorem...</textarea>
          </div>
          <div class="form-group">
            <label for="country">Location</label>
            <select class="form-control my-2" id="country">
              <option>Nepal</option>
            </select>
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <p class="text-muted my-2">Upload up to 5 photos.</p>
            <div class="d-flex flex-wrap" id="photo-container">

              <div class="photo-upload-box" id="add-photo">
                <i class="fas fa-plus"></i>
                <input type="file" id="photo-input" class="d-none" accept="image/*">
              </div>
            </div>
          </div>
          <div class="btn-cancel-save d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-cancel-advertisement">Cancel</button>
            <button type="submit" class="btn btn-save-changes-advertisement">Save Changes</button>
          </div>

        </form>
      </div>
    </div>
  </div>



@endsection



