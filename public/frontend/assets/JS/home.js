// function showSection(sectionId) {
//     // Hide all content sections
//     var sections = document.querySelectorAll('.content-section');
//     sections.forEach(function (section) {
//         section.classList.remove('active');
//     });

//     // Show the selected section
//     var activeSection = document.getElementById(sectionId);
//     activeSection.classList.add('active');

//     // Optionally: Update the active link in the sidebar
//     var links = document.querySelectorAll('.list-group-item');
//     links.forEach(function (link) {
//         link.classList.remove('active-profile');
//     });
//     document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active-profile');
// }