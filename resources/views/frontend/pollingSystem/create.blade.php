@extends('frontend.layouts.main')

@section('title', 'Exit Poll')

@section('content')
<section class="prform">
    <div class="container-fluid container-lg">
        <div id="form-container">
            <div id="Pollsystem" class="multi-step-form">
                <div class="container">
                    <div class="">
                        <div class="border border-1 rounded-2 p-5 w-100 mt-5" style="box-shadow: 2px 2px 12px 0px #00000014;">
                            <div class="card-body">
                                <h6 class="text-primary" style="font-size: 28px; font-weight: 600;">Exit Poll</h6>
                                <p class="py-2" style="font-size: 24px; font-weight: 600;">{{ $pollQuestion->question }}</p>

                                <form method="POST" action="{{ route('polls.store') }}" id="pollForm">
                                    @csrf
                                    <input type="hidden" name="polling_question_id" value="{{ $pollQuestion->id }}">

                                    <div class="poll-options">
                                        @foreach($pollQuestion->answers as $answer)
                                        @php
                                        $colors = ['#212525', '#0064A7', '#308942', '#5F43C1', '#DE3438'];
                                        $color = $colors[$loop->index % count($colors)];
                                        $totalVotes = $pollQuestion->polls->count();
                                        $answerVotes = $answer->polls->count();
                                        $percentage = $totalVotes > 0 ? round(($answerVotes / $totalVotes) * 100, 1) : 0;
                                        $checkedAnswerId = $pollQuestion->polls
                                            ->where('jobSeekerId', Auth::guard('job_seekers')->id())
                                            ->where('polling_answer_id', $answer->id)
                                            ->where('polling_question_id', $pollQuestion->id)
                                            ->pluck('polling_answer_id')->first();
                                        
                                        @endphp

                                        <div class="d-flex align-items-center mb-2 poll-option" style="width: 100%;">
                                            <!-- 40%: Radio button + answer label -->
                                            <div class="me-3 mb-4" style="width: 23%; display: flex; align-items: center;">
                                                <input type="radio"
                                                    name="polling_answer_id"
                                                    id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}"
                                                    class="me-3 vote-radio"
                                                    style="transform: scale(1.3);" 
                                            
                                                    {{ $checkedAnswerId == $answer->id ? 'checked' : '' }}
                                                    />
                                                <label for="answer-{{ $answer->id }}"
                                                    style="font-size: 22px; font-weight: 600; margin-bottom: 0;">
                                                    {{ $answer->answer }}
                                                    
                                                </label>
                                                
                                            </div>

                                            <!-- 60%: Percentage bar -->
                                            <div class="bar-container me-4" style="width: 82%; position: relative; height: 40px; border-radius: 4px; background-color: #dee2e6; overflow: hidden;">
                                                @if($percentage > 0)
                                                <div class="bar-fill text-white"
                                                    style="width: {{ $percentage }}%; background-color: {{ $color }}; height: 100%; display: flex; align-items: center; padding-left: 10px; position: absolute; top: 0; left: 0;">
                                                    @if($percentage > 5)
                                                    {{ $percentage }}%
                                                    @endif
                                                </div>
                                                @endif
                                                <div class="text-white"
                                                    style="padding-left: 10px; line-height: 40px; font-weight: 500; position: relative; z-index: 1;">
                                                    {{ $percentage }}%
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @endforeach
                                    </div>

                                    <!-- Hidden submit button for accessibility -->
                                    <button type="submit" class="d-none">Submit</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</section>
 <section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
            <h2 class="py-4">Advertisement Banner</h2>
        </section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('.vote-radio');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    setTimeout(() => {
                        document.getElementById('pollForm').submit();
                    }, 100);
                }
            });
        });
    });
</script>
@endpush
@endsection