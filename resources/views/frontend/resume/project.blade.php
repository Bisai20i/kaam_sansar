 <!-- Project Section (Initially Hidden) -->
 <div id="project" class="section-content" style="display:none;">
     <h4 class="mb-3 your-project-text">Your Projects</h4>
     <div class="card card-center">
         <form id="projectForm">

             <div class="mb-3">
                 <h1>Projects</h1>
             </div>
             <div class="mb-3">
                 <label class="form-label">Project Title</label>
                 <input type="url" class="form-control custom-input" name="projectTitle" id="projectTitle"
                     placeholder="">
             </div>
             <div class="mb-3">
                 <label class="form-label">Project Link</label>
                 <input type="url" class="form-control custom-input" name="projectLink" id="projectLink"
                     placeholder="">
             </div>
             <div class="mb-3">
                 <label class="form-label">Description</label>
                 <textarea class="form-control custom-input" rows="4" id="projectDescription" name="projectDescription" placeholder=""></textarea>
             </div>

             <div class="d-flex justify-content-between">
                 <button type="button" class="btn add-project float-start" id="addProject">
                     + Add Project
                 </button>
                 <div class="text-end">
                     <button type="submit" class="btn text-center skip-btn mx-2" data-current="project" data-next="skill" data-link="skillLink">Skip</button>
                     <button type="button" class="btn text-center next-btn" id="submitProject">Save & Continue</button>
                 </div>
             </div>
         </form>
     </div>
     <div class="container mt-4 p-0">
         <div id="projectList"></div>
         @if($projects->isNotEmpty())
         @foreach($projects as $project)
         <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
             <div class="d-flex justify-content-between">
                 <div>
                     <h5>{{ $project->projectTitle ?? ''}}</h5>
                 </div>
                 <div>
                     <a href="{{ route('projects.edit', $project->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                         Edit
                     </a>
                     <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn text-danger fw-semibold">
                             Delete
                         </button>
                     </form>
                 </div>
             </div>
             <div class="text-black-50">
                 @if($project->projectLink)
                 <p class="m-0">
                     <a href="{{ $project->projectLink ?? ''}}" target="_blank" style="color: #0064A7;">
                         {{ $project->projectLink ?? ''}}
                     </a>
                 </p>
                 @endif
                 <p class="m-0">{{ $project->projectDescription }}</p>
             </div>
         </div>
         @endforeach
         @endif
     </div>
 </div>
 @push('scripts')
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         function collectProjectData() {
             return {
                 projectTitle: document.getElementsByName('projectTitle')[0].value,
                 projectLink: document.getElementsByName('projectLink')[0].value,
                 projectDescription: document.getElementsByName('projectDescription')[0].value
             };
         }

         async function saveProjectData(projectData) {
             try {
                 const response = await fetch("{{ route('projects.store') }}", {
                     method: "POST",
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },
                     body: JSON.stringify(projectData)
                 });
                 return await response.json();
             } catch (error) {
                 console.error("Error saving project data:", error);
                 return {
                     success: false
                 };
             }
         }

         function appendProjectCard(project) {
             // grab CSRF once
             const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

             const card = document.createElement('div');
             card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';

             card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div>
                    <h5>${project.projectTitle}</h5>
                    </div>
                    <div>
                    <a href="/projects/${project.id}/edit" class="btn fw-semibold" style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="/projects/${project.id}" method="POST" style="display:inline;">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn text-danger fw-semibold">
                        Delete
                        </button>
                    </form>
                    </div>
                </div>
                <div class="text-black-50">
                    ${project.projectLink ? `
                    <p class="m-0">
                        <a href="${project.projectLink}" target="_blank" style="color: #0064A7;">
                        ${project.projectLink} 
                        </a>
                    </p>
                    ` : ''}
                    <p class="m-0">${project.projectDescription || ''}</p>
                </div>
                `;

             document.getElementById('projectList').appendChild(card);
         }


         document.getElementById('projectForm').addEventListener('submit', function(e) {
             e.preventDefault();
         });

         document.getElementById('addProject').addEventListener('click', async function(e) {
             e.preventDefault();
             console.log(collectProjectData());
             const projectData = collectProjectData();
             const result = await saveProjectData(projectData);
             if (result.success) {
                 const project = result.project;
                 document.getElementById('overviewProjects').innerHTML = `
                        <p><strong>Project Title:</strong> ${project.projectTitle}</p>
                        <p><strong>Project Link:</strong> <a href="${project.projectLink}" target="_blank">${project.projectLink}</a></p>
                        <p><strong>Project Description:</strong> ${project.projectDescription}</p>
                    `;
                 document.getElementById('projectForm').reset();
                 appendProjectCard(result.project); 
             }
         });

         document.getElementById('submitProject').addEventListener('click', async function(e) {
             e.preventDefault();
             console.log(collectProjectData());
             const projectData = collectProjectData();
             const result = await saveProjectData(projectData);
             if (result.success) {
                const project = result.project;
                 document.getElementById('overviewProject').innerHTML = `
                        <p><strong>Project Title:</strong> ${project.projectTitle}</p>
                        <p><strong>Project Link:</strong> <a href="${project.projectLink}" target="_blank">${project.projectLink}</a></p>
                        <p><strong>Project Description:</strong> ${project.projectDescription}</p>
                    `;
                 appendProjectCard(result.project); 
                 document.getElementById('project').style.display = 'none';
                 document.getElementById('skill').style.display = 'block';
                 document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                 document.getElementById('skillLink').classList.add('active');
             }
         });

     })
 </script>
 @endpush