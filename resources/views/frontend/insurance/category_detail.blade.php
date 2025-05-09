<div class="tab-pane fade show bg-white" style="display:block;">
    <div class="card mt-2 rounded-1 overflow-hidden" >
        <img class="p-0 img img-fluid" src="{{ $category->insuranceDetail->thumbnail }}" alt="" style="box-sizing: border-box !important;">
        <div class="insurance-text mx-3 my-3">
            <h5 class="card-title">
                {{ $category->name }}
            </h5>
            <article class="card-text my-2 py-2">

                {!! 
                    $category->insuranceDetail->description !!}

            </article>
        </div>

        @if($category->subCategory->count() > 0)


        <div class="row p-3">

            @foreach($category->subCategory as $detail)


            <div class="col-12 col-md-6 mb-4 ">
                <div class="card border-1 p-4">
                    <h4 class="card-title font-weight-bold text-center py-2">{{ $detail->name }}</h4>
                    <p class="card-text">{!! $detail->description !!}</p>
                    <a href="#" class="btn btn-buy-now ">Buy Now</a>

                </div>
            </div>


            @endforeach

            
        </div>


        @endif
        

    </div>
</div>
