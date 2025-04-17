document.addEventListener("DOMContentLoaded", function () {
    const loginPhoneInput = document.getElementById('loginPhone');
    const registerPhoneInput = document.getElementById('registerPhone');

    const itiLogin = intlTelInput(loginPhoneInput, {
        initialCountry: 'np',
        preferredCountries: ['np', 'us', 'gb', 'ca', 'in'],
        autoHideDialCode: false,
        separateDialCode: true,
        nationalMode: false,
    });

    const itiRegister = intlTelInput(registerPhoneInput, {
        initialCountry: 'np',
        preferredCountries: ['np', 'us', 'gb', 'ca', 'in'],
        autoHideDialCode: false,
        separateDialCode: true,
        nationalMode: false,
    });

    // Set number format explicitly to include country code
    loginPhoneInput.addEventListener("countrychange", function () {
        loginPhoneInput.value = itiLogin.getNumber();
    });

    registerPhoneInput.addEventListener("countrychange", function () {
        registerPhoneInput.value = itiRegister.getNumber();
    });

    loginPhoneInput.focus();
});

// Function to toggle password visibility for both login and register forms
function togglePasswordVisibility(form) {
    const passwordField = document.getElementById(`${form}Password`);
    const confirmPasswordField = document.getElementById(`${form}ConfirmPassword`);
    const eyeIcon = document.getElementById(form === 'login' ? 'eyeIcon' : 'eyeIconRegister');

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.src = "Images/icons8-eye-48.png";  // Change to the "show" icon
    } else {
        passwordField.type = "password";
        eyeIcon.src = "Images/icons8-invisible-48.png";  // Change to the "hide" icon
    }
}

function showSection(sectionId) {
    // Hide all content sections
    var sections = document.querySelectorAll('.content-section');
    sections.forEach(function (section) {
        section.classList.remove('active');
    });

    // Show the selected section
    var activeSection = document.getElementById(sectionId);
    activeSection.classList.add('active');

    // Optionally: Update the active link in the sidebar
    var links = document.querySelectorAll('.list-group-item');
    links.forEach(function (link) {
        link.classList.remove('active-profile');
    });
    document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active-profile');
}

//Profile-login/register phone and email

document.addEventListener("DOMContentLoaded", function () {
    const emailBtn = document.getElementById("email-btn");
    const phoneBtn = document.getElementById("phone-btn");
    const emailForm = document.getElementById("email-form");
    const phoneForm = document.getElementById("phone-form");
    const eyeIcon = document.getElementById("eyeIcon");
    const passwordInput = document.getElementById("loginPassword");

    // Toggle between email and phone form
    emailBtn.addEventListener("click", function () {
        emailForm.classList.remove("d-none");
        phoneForm.classList.add("d-none");
        emailBtn.classList.add("active");
        phoneBtn.classList.remove("active");
    });

    phoneBtn.addEventListener("click", function () {
        phoneForm.classList.remove("d-none");
        emailForm.classList.add("d-none");
        phoneBtn.classList.add("active");
        emailBtn.classList.remove("active");
        phoneForm.style.display = "block"; // Ensure visibility
    });

    // Email validation function
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Phone validation function
    function validatePhone(phone) {
        const re = /^[0-9]{10}$/; // Assumes 10-digit phone number
        return re.test(phone);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const emailBtn1 = document.getElementById("email-btn-register");
    const phoneBtn1 = document.getElementById("phone-btn-register");
    const emailContainer = document.getElementById("email-container");
    const phoneContainer = document.getElementById("phone-container");

    phoneBtn1.addEventListener("click", function () {
        phoneContainer.style.display = "block";
        emailContainer.style.display = "none";
        phoneBtn1.classList.add("active");
        emailBtn1.classList.remove("active");
        emailBtn1.disabled = false;  // Re-enable the email button
    });

    emailBtn1.addEventListener("click", function () {
        emailContainer.style.display = "block";
        phoneContainer.style.display = "none";
        emailBtn1.classList.add("active");
        phoneBtn1.classList.remove("active");
        emailBtn1.disabled = true;  // Disable the email button after clicking on it
    });
});

//Horoscope section button
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".button-container-horoscope button");
    const sections = document.querySelectorAll(".horoscope-section");

    // Function to show the selected section and hide others
    function showSection(sectionId) {
        sections.forEach(section => {
            section.style.display = "none"; // Hide all sections
        });

        document.getElementById(sectionId).style.display = "block"; // Show the selected section

        buttons.forEach(button => {
            button.classList.remove("btn-primary", "active");
            button.classList.add("btn-outline-primary");
        });

        // Activate the clicked button
        document.getElementById(sectionId + "Btn").classList.remove("btn-outline-primary");
        document.getElementById(sectionId + "Btn").classList.add("btn-primary", "active");
    }

    // Attach event listeners to all buttons
    document.getElementById("dailyBtn").addEventListener("click", () => showSection("daily"));
    document.getElementById("weeklyBtn").addEventListener("click", () => showSection("weekly"));
    document.getElementById("monthlyBtn").addEventListener("click", () => showSection("monthly"));
    document.getElementById("yearlyBtn").addEventListener("click", () => showSection("yearly"));

    // Set default active section
    showSection("daily");
});

// Function to show horoscope details in the modal
function showDescription(title, description) {
    document.getElementById("horoscopeTitle").innerText = title;
    document.getElementById("horoscopeDescription").innerText = description;
}


// Show Girls Section in kundali
document.getElementById("nextButton").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form submission
    document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
    document.getElementById("Boys-Section").style.display = "block"; // Show Boys Section
    document.getElementById("Boys-Section").scrollIntoView({ behavior: "smooth" });
});

// Show Thanks Section
document.getElementById("MatchButton").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form submission
    document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
    document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
    document.getElementById("Thanks-Section").style.display = "block"; // Show Thanks Section
    document.getElementById("Thanks-Section").scrollIntoView({ behavior: "smooth" });
});

// Go back to Girls Section when clicking the arrow icon
document.getElementById("backButton").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default action
    document.getElementById("Girls-Section").style.display = "block"; // Show Girls Section
    document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
    document.getElementById("Girls-Section").scrollIntoView({ behavior: "smooth" });
});
document.querySelector(".ok-btn").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent any default behavior of the button
    document.getElementById("Thanks-Section").style.display = "none"; // Hide the Thanks Section
    document.getElementById("Girls-Section").style.display = "block"; // Show the Girls Section
    document.getElementById("Girls-Section").scrollIntoView({ behavior: "smooth" }); // Scroll to Girls Section
});


//Visa Hq
document.addEventListener("DOMContentLoaded", function () {
    const applyButton = document.querySelector(".btn-apply");
    const visaTypeDropdown = document.getElementById("visaType");

    const workingReq = document.getElementById("workingReq");
    const touristReq = document.getElementById("touristReq");
    const businessReq = document.getElementById("businessReq");

    // Initially hide all visa requirement sections
    workingReq.style.display = "none";
    touristReq.style.display = "block";
    businessReq.style.display = "none";

    applyButton.addEventListener("click", function () {
        // Hide all sections first
        workingReq.style.display = "none";
        touristReq.style.display = "none";
        businessReq.style.display = "none";

        // Show only the selected visa type's requirements
        const selectedVisa = visaTypeDropdown.value;
        if (selectedVisa === "working") {
            workingReq.style.display = "block";
        } else if (selectedVisa === "tourist") {
            touristReq.style.display = "block";
        } else if (selectedVisa === "business") {
            businessReq.style.display = "block";
        }
    });
});

// Get the Apply Now Button and Dropdown Container
const applyButton = document.querySelector('.btn-apply');
const dropdownContainer = document.querySelector('.dropdown-container-visa');

// Handle Apply Now Button Click
applyButton.addEventListener('click', function () {
    // Move the dropdown container to its original position (simulated)
    dropdownContainer.style.position = 'absolute';
    dropdownContainer.style.top = '50px'; // Change this to match your original position
    dropdownContainer.style.left = '20px'; // Adjust the position as needed
});



//RESUME MAKER//


// Profile Form Submit handler
document.getElementById('profileForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission

    // Collect Profile Data
    const profileData = {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        designation: document.getElementById('designation').value,
        address: document.getElementById('address').value,
        country: document.getElementById('country').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        summary: document.getElementById('summary').value,
        profileImage: document.getElementById('profilePreview').src
    };

    // Update Overview Section
    document.getElementById('overviewName').textContent = `${profileData.firstName} ${profileData.lastName}`;
    document.getElementById('overviewRole').textContent = profileData.designation;
    document.getElementById('overviewImage').src = profileData.profileImage;

    // Optional: Show profile summary in the overview
    document.getElementById('overviewContent').innerHTML = `
            <p><strong>Address:</strong> ${profileData.address}</p>
            <p><strong>Country:</strong> ${profileData.country}</p>
            <p><strong>Email:</strong> ${profileData.email}</p>
            <p><strong>Phone:</strong> ${profileData.phone}</p>
            <p><strong>Summary:</strong> ${profileData.summary}</p>
        `;

    // Show next section (Visa form)
    document.getElementById('profile').style.display = 'none';
    document.getElementById('visa').style.display = 'block';
});

// Profile Image Preview function
function previewProfile(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(file);
}

function activateSection(clickedId) {
    // Remove the 'active' class from all links
    const links = document.querySelectorAll('.profile-link');
    links.forEach(link => {
        link.classList.remove('active');
    });

    // Add the 'active' class to the clicked link
    const clickedLink = document.getElementById(clickedId);
    clickedLink.classList.add('active');

    // Hide all sections
    const sections = document.querySelectorAll('.section-content');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the corresponding section
    const sectionId = clickedId.replace('Link', ''); // Remove 'Link' suffix to get the section ID
    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = 'block';
    }
}

// Initialize with Profile Information section active
document.getElementById('profileLink').click();

// Visa Next Button Click Event
document.getElementById('submitVisa').addEventListener('click', function () {
    // Hide the Visa form and show the Education form
    document.getElementById('visa').style.display = 'none';
    document.getElementById('education').style.display = 'block';
});

// Education Add Button Click Event
document.getElementById('addEducation').addEventListener('click', function () {
    // Collect the data from the Education form
    const educationData = {
        schoolName: document.getElementById('schoolName').value,
        degree: document.getElementById('degree').value,
        city: document.getElementById('city').value,
        startDate: document.getElementById('startDate').value,
        gradDate: document.getElementById('gradDate').value,
        summary: document.getElementById('summary').value
    };

    // Create the education entry HTML
    const educationEntry = `
            <h4>Your Education</h4>
            <p><strong>School Name:</strong> ${educationData.schoolName}</p>
            <p><strong>Degree:</strong> ${educationData.degree}</p>
            <p><strong>City:</strong> ${educationData.city}</p>
            <p><strong>Start Date:</strong> ${educationData.startDate}</p>
            <p><strong>Graduation Date:</strong> ${educationData.gradDate}</p>
            <p><strong>Summary:</strong> ${educationData.summary}</p>
        `;

    // Update the overview with the new education entry
    document.getElementById('overviewEducation').innerHTML += educationEntry;

    // Clear the form fields for new input
    document.getElementById('schoolName').value = '';
    document.getElementById('degree').value = '';
    document.getElementById('city').value = '';
    document.getElementById('startDate').value = '';
    document.getElementById('gradDate').value = '';
    document.getElementById('summary').value = '';

    // Optionally, focus on the first field to improve user experience
    document.getElementById('schoolName').focus();
});

// Visa Next Button Click Event
document.getElementById('submitEducation').addEventListener('click', function () {
    // Hide the Education form and show the Project form
    document.getElementById('education').style.display = 'none';
    document.getElementById('project').style.display = 'block';
});

// Function to add a project to the overview section
document.getElementById('addProjectButton').addEventListener('click', function () {
    // Get the values from the form fields
    const title = document.getElementById('projectTitle').value;
    const link = document.getElementById('projectLink').value;
    const description = document.getElementById('projectDescription').value;

    // Validate that all fields are filled out
    if (title === "" || link === "" || description === "") {
        alert("Please fill in all fields.");
        return; // Exit if any field is empty
    }

    // Create a new div for the project
    const projectDiv = document.createElement('div');
    projectDiv.classList.add('project-item');

    // Add project content to the new div
    projectDiv.innerHTML = `
    <h5>${title}</h5>
    <a href="${link}" target="_blank">${link}</a>
    <p>${description}</p>
`;

    // Append the new project div to the overviewProjects section
    const overviewProjects = document.getElementById('overviewProjects');
    overviewProjects.appendChild(projectDiv);

    // Clear the form inputs
    document.getElementById('projectForm').reset();
});

document.getElementById('submitProject').addEventListener('click', function () {
    // Hide the Education form and show the Project form
    document.getElementById('project').style.display = 'none';
    document.getElementById('skills').style.display = 'block';
});

// Add Skill Button Event
document.getElementById('addSkillBtn').addEventListener('click', function () {
    const skillName = document.getElementById('SKill').value.trim();
    const skillLevel = document.getElementById('skill').value;

    if (!skillName) {
        alert("Please enter a skill before adding.");
        return;
    }

    // Create the skill entry HTML
    const skillEntry = `
        <div class="skill-entry">
            <p><strong>${skillName}</strong> - <em>${skillLevel}</em></p>
        </div>
    `;

    // Add the new skill to the overview section
    const skillsList = document.getElementById('overviewSkills');
    if (skillsList) {
        skillsList.innerHTML += skillEntry;
    } else {
        console.error('Skills list container not found!');
    }

    // Clear the form input field
    document.getElementById('SKill').value = '';

});

// Skills Form Submit handler (optional if needed for submission)
document.getElementById('skillsForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    // Handle form submission logic if needed
});

document.getElementById('submitSkills').addEventListener('click', function () {
    // Hide the Education form and show the Project form
    document.getElementById('skills').style.display = 'none';
    document.getElementById('achievements').style.display = 'block';
});

//Add achievements in Overview
document.getElementById('addAchievementBtn').addEventListener('click', function () {
    const achievementTitle = document.getElementById('achievement-title').value.trim();
    const achievementDescription = document.getElementById('achievement-description').value.trim();

    // Check if both fields have content
    if (!achievementTitle || !achievementDescription) {
        alert("Please enter both title and description before adding.");
        return;
    }

    // Create the achievement entry HTML
    const achievementEntry = `
                        <div class="achievement-entry">
                            <p><strong>${achievementTitle}</strong></p>
                            <p>${achievementDescription}</p>
                        </div>
                    `;

    // Update the achievements overview section
    const achievementsList = document.getElementById('overviewAchievements');
    if (achievementsList) {
        achievementsList.innerHTML += achievementEntry;  // Append new achievement entry to the list
    } else {
        console.error('Achievements list container not found!');
    }

    // Clear the form input fields after adding the achievement
    document.getElementById('achievement-title').value = '';
    document.getElementById('achievement-description').value = '';
});

// Achievements Form Submit handler (optional if needed for form submission)
document.getElementById('achievementsForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    // Handle form submission logic if needed
});

document.getElementById('submitAchievement').addEventListener('click', function () {
    // Hide the Education form and show the Project form
    document.getElementById('achievements').style.display = 'none';
    document.getElementById('experience').style.display = 'block';
});

// Add Experience Button Event
document.getElementById('addExperienceBtn').addEventListener('click', function () {
    const jobTitle = document.getElementById('experience-job-title').value.trim();
    const companyName = document.getElementById('experience-company-name').value.trim();
    const location = document.getElementById('experience-location').value.trim();
    const startDate = document.getElementById('experience-start-date').value.trim();
    const endDate = document.getElementById('experience-end-date').value.trim();
    const description = document.getElementById('experience-description').value.trim();

    // Create the experience entry HTML
    const experienceEntry = `
                <p><strong>${jobTitle}</strong> at <em>${companyName}</em> - ${location}</p>
                <p><strong>Duration:</strong> ${startDate} to ${endDate}</p>
                <p><strong>Description:</strong> ${description}</p>
        `;

    // Append the experience entry to the overview section
    const experienceList = document.getElementById('overviewExperiences');
    experienceList.innerHTML += experienceEntry;

    // Clear the form input fields after adding the experience
    document.getElementById('experience-job-title').value = '';
    document.getElementById('experience-company-name').value = '';
    document.getElementById('experience-location').value = '';
    document.getElementById('experience-start-date').value = '';
    document.getElementById('experience-end-date').value = '';
    document.getElementById('experience-description').value = '';

    document.getElementById('submitExperience').addEventListener('click', function () {
        // Hide the Education form and show the Project form
        document.getElementById('experience').style.display = 'none';
        document.getElementById('trainings').style.display = 'block';
    });

    document.getElementById('addTrainingBtn').addEventListener('click', function () {
        const title = document.getElementById('training-title').value.trim();
        const organization = document.getElementById('training-organization').value.trim();
        const date = document.getElementById('training-date').value.trim();

        const trainingList = document.getElementById('overviewTrainings');

        // Create a new training entry
        const trainingEntry = document.createElement('div');
        trainingEntry.innerHTML = `
            <p><strong>${title}</strong> - <em>${organization}</em></p>
            <p><strong>Completion Date:</strong> ${date}</p>
        `;

        trainingList.appendChild(trainingEntry);

        // Clear input fields
        document.getElementById('training-title').value = '';
        document.getElementById('training-organization').value = '';
        document.getElementById('training-date').value = '';
    });

    document.getElementById('submitTraining').addEventListener('click', function () {
        // Hide the Education form and show the Project form
        document.getElementById('trainings').style.display = 'none';
        document.getElementById('language').style.display = 'block';
    });

    //Add language
    document.getElementById('addLanguageBtn').addEventListener('click', function () {
        const languageName = document.getElementById('Language').value.trim();
        const languageLevel = document.getElementById('languageLevel').value;


        // Create a new language entry
        const languageEntry = document.createElement("div");
        languageEntry.innerHTML = `
                                    <p><strong>${languageName}</strong> - <em>${languageLevel}</em></p>
                                `;

        // Append to the overview section
        const languagesList = document.getElementById('overviewLanguages');
        if (languagesList) {
            languagesList.appendChild(languageEntry);
        } else {
            console.error('Languages list container not found!');
        }

        // Clear input fields
        document.getElementById('Language').value = '';

        // Attach event listener to remove button
        languageEntry.querySelector('.removeLanguageBtn').addEventListener('click', function () {
            this.parentElement.remove();
        });
    });
});


//Visa Hq

function changeVisaRequirements() {
    // Get the selected visa type
    const visaType = document.getElementById('visaType').value;

    // Hide all visa requirement sections
    document.getElementById('workingReq').style.display = 'none';
    document.getElementById('touristReq').style.display = 'none';
    document.getElementById('businessReq').style.display = 'none';

    // Show the corresponding visa requirement section based on the selected visa type
    if (visaType === 'working') {
        document.getElementById('workingReq').style.display = 'block';
    } else if (visaType === 'tourist') {
        document.getElementById('touristReq').style.display = 'block';
    } else if (visaType === 'business') {
        document.getElementById('businessReq').style.display = 'block';
    }

    // Change the profile header style when the Apply Now button is clicked
    document.getElementById('profileHeader').classList.add('wrap');
}

document.addEventListener("DOMContentLoaded", function () {
    // Set initial state
    document.getElementById('paymentSection').classList.add('d-none'); // Hide payment section initially
    document.querySelector('.step-button').classList.add('active1'); // Make Application button active
});

function setActive(index) {
    const buttons = document.querySelectorAll('.step-button');
    const highlight = document.getElementById('highlight');
    const paymentSection = document.getElementById('paymentSection');
    const applicationForm = document.getElementById('applicationForm');

    // Update active step
    buttons.forEach((btn, i) => {
        btn.classList.toggle('active1', i === index);
    });

    // Move the highlight bar
    highlight.style.left = `${index * 50}%`;

    // Toggle visibility of sections
    if (index === 1) {
        paymentSection.classList.remove('d-none');
        applicationForm.classList.add('d-none');
    } else {
        paymentSection.classList.add('d-none');
        applicationForm.classList.remove('d-none');
    }
}

//image
let selectedImages = [];

document.getElementById('imageUpload').addEventListener('change', function (event) {
    let files = [...event.target.files];

    if (selectedImages.length + files.length > 5) {
        alert("You can upload a maximum of 5 images.");
        return;
    }

    files.forEach(file => {
        if (file.size > 2 * 1024 * 1024) {
            showError(`${file.name} exceeds 2MB.`);
            return;
        }

        if (selectedImages.length >= 5) return;

        selectedImages.push(file.name);
        const reader = new FileReader();

        reader.onload = e => {
            const imageWrapper = document.createElement('div');
            imageWrapper.classList.add('image-wrapper');
            imageWrapper.style.position = 'relative';

            imageWrapper.innerHTML = `
                                <img src="${e.target.result}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                <button type="button" class="remove-btn" style="position: absolute;background:transparent; right:10px; color: red; border: none; width: 20px; height: 20px; border-radius: 50%;" onclick="removeImage(this, '${file.name}')"><i class=
                                    "bi bi-x fa-2x"></i></button>
                                <input type="file" class="hidden-input" accept="image/*" style="display: none;" onchange="replaceImage(event, this)">
                            `;

            document.getElementById('imagePreview').appendChild(imageWrapper);
            toggleUpload();
        };

        reader.readAsDataURL(file);
    });
});

function removeImage(button, name) {
    button.parentElement.remove();
    selectedImages = selectedImages.filter(img => img !== name);
    toggleUpload();
}

function editImage(button) {
    button.nextElementSibling.click();
}

function replaceImage(event, input) {
    const file = event.target.files[0];
    if (file && file.size <= 2 * 1024 * 1024) {
        const reader = new FileReader();
        reader.onload = e => input.parentElement.querySelector('img').src = e.target.result;
        reader.readAsDataURL(file);
    }
}

function showError(message) {
    const errorDiv = document.getElementById('imageError');
    errorDiv.innerHTML = message;
    errorDiv.style.display = message ? 'block' : 'none';
}

function toggleUpload() {
    document.getElementById('imageUpload').disabled = selectedImages.length >= 5;
}

//Abroad chat
function setActive(tabIndex) {
    // Get all buttons and sections
    var buttons = document.querySelectorAll('.step-button-abroad');
    var descriptionSection = document.getElementById('description');
    var commentSection = document.getElementById('comment');

    buttons.forEach(function (button) {
        button.classList.remove('active1');
    });

    descriptionSection.style.display = 'none';
    commentSection.style.display = 'none';

    buttons[tabIndex].classList.add('active1');

    if (tabIndex === 0) {
        descriptionSection.style.display = 'block';
    } else if (tabIndex === 1) {
        commentSection.style.display = 'block';
    }
}

window.onload = function () {
    setActive(0); 
}


function toggleChat() {
    const chatBox = document.getElementById("chatBox");
    chatBox.style.display = chatBox.style.display === "block" ? "none" : "block";
}


document.getElementById("newUploadImageButton-1").addEventListener("click", function () {
    document.getElementById("newImageInput").click();
});

document.getElementById("newImageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        if (!file.type.startsWith("image/")) {
            alert("Please upload a valid image file.");
            return;
        }
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("newImagePreview").src = e.target.result;
            document.getElementById("newAddToPostInput").value = file.name; // Display filename in input
            document.getElementById("newImagePreviewContainer").classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    }
});

// Remove Image Functionality
document.getElementById("removeImageButton").addEventListener("click", function () {
    document.getElementById("newImagePreview").src = "";
    document.getElementById("newAddToPostInput").value = "";
    document.getElementById("newImageInput").value = ""; // Reset file input
    document.getElementById("newImagePreviewContainer").classList.add("d-none");
});

document.getElementById('uploadImageButton-1').addEventListener('click', function () {
    document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = event.target.result;
            imagePreviewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});


function filterCategory(category, btn) {
    let products = document.querySelectorAll('.product');
    products.forEach(product => {
        product.style.display = (category === 'all' || product.getAttribute('data-category') === category) ? 'block' : 'none';
    });

    document.querySelectorAll('.category-btn').forEach(button => button.classList.remove('active-btn'));
    btn.classList.add('active-btn');
}

document.addEventListener("DOMContentLoaded", function () {
    const defaultButton = document.querySelector('.category-btn');
    if (defaultButton) {
        filterCategory('all', defaultButton);
    }
});
function toggleActive(button) {
    document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    const addItemBtn = document.getElementById('addItemBtn');
    const itemForm = document.getElementById('itemForm');
    const wantToBuyForm = document.getElementById('wantToBuyForm');

    if (!addItemBtn || !itemForm || !wantToBuyForm) {
        console.error("One or more elements are missing.");
        return;
    }

    if (button.textContent.trim() === "Want to buy") {
        itemForm.style.display = 'none';
        wantToBuyForm.style.display = 'block';
        addItemBtn.textContent = "+ Add Post";
        addItemBtn.setAttribute('data-bs-target', '#addPostModal');
    } else {
        itemForm.style.display = 'block';
        wantToBuyForm.style.display = 'none';
        addItemBtn.textContent = "+ Add Item";
        addItemBtn.setAttribute('data-bs-target', '#addItemModal');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const defaultButton = document.querySelector('.btn-all-categories');
    if (defaultButton) {
        toggleActive(defaultButton);
    }
});