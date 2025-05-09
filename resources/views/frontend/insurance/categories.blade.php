@extends('frontend.insurance.index')

@section('insurance_content')

    <section class="new-insurance pt-3 pb-5" id="new-insurance">
        <div class="container">
            <div class="row">
                <!-- sidebar-insurance -->
                <nav class="col-md-4 col-lg-3 col-sm-3 sidebar-insurance">
                    <div class="position-sticky">

                        @if ($categories->count() > 0)
                            <ul class="nav flex-column pt-2">

                                @foreach ($categories as $category)
                                    <li class="nav-item mb-4">
                                        <a class="nav-link rounded-1 border border-1 active category-link"
                                            data-category-id="{{ $category->id }}" href="javascript:void(0);">
                                            <i class="bi bi-file-medical pe-1"></i>{{ ucfirst( $category->name) }}
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        @else
                            <p class="text-muted my-2"> <small>No Categories</small></p>
                        @endif

                    </div>
                </nav>
                <!-- Main Contendt -->
                <main class="col-md-8 col-lg-9 col-sm-9 ">
                    <div class="tab-content mt-2" id="categoryDisplayContainer">

                        
                    </div>
                </main>
            </div>
        </div>

    </section>

@endsection

@push('scripts')
    <script>
        function getBaseUrl() {
            return window.location.protocol + "//" + window.location.host;
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Handle category link clicks
            document.querySelectorAll('.category-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryId = this.getAttribute('data-category-id');
                    loadCategoryDetails(categoryId);

                    // Update active state
                    document.querySelectorAll('.category-link').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            // Function to load category details via AJAX
            function loadCategoryDetails(categoryId) {
                console.log(categoryId)
                fetch( getBaseUrl() + `/insurance/details/${categoryId}`,{
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => {
                        console.log("response",response)
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        console.log(response)
                        if(response){

                        }
                        return response.text();
                    })
                    .then(html => {
                        document.getElementById('categoryDisplayContainer').innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error loading category:', error);
                        document.getElementById('categoryDisplayContainer').innerHTML = `
                        <div class="text-muted p-2 rounded-1 border border-1 border-secondary-subtle">
                            <p class="my-1">No Details Found for this Insurance.</p>
                        </div>
                        `;
                    });
            }

            // Load the first category by default (optional)
            @if ($categories->count() > 0)
                const firstCategoryLink = document.querySelector('.category-link');
                if (firstCategoryLink) {
                    firstCategoryLink.click();
                }
            @endif
        });
    </script>
@endpush
