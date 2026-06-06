@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="fw-bold mb-4">Gift Finder: Find the Perfect Gift!</h2>
    <p class="mb-4 text-muted">Share your preferences, and we will suggest the best gifts for you.</p>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 border-0">
                
                {{-- Form action route 'quiz.results' par POST request bhej raha hai --}}
                <form action="{{ route('quiz.results') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Who is the gift for?</label>
                        <select name="recipient" class="form-select" required>
                            <option value="partner">Partner</option>
                            <option value="friend">Friend</option>
                            <option value="parent">Parent</option>
                            <option value="sister">Sister</option>
                            <option value="brother">Brother</option>
                        </select>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">What is the occasion?</label>
                        <select name="occasion" class="form-select" required>
                            <option value="birthday">Birthday</option>
                            <option value="anniversary">Anniversary</option>
                            <option value="wedding">Wedding</option>
                            <option value="graduation">Graduation</option>
                        </select>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary w-100 py-2 mt-3 fw-bold">
                        Show Results
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection