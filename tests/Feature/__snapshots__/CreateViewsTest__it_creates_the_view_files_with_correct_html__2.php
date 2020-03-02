<?php return '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    @include(\'shared._errors\')
    <form method="POST" action="{{ route(\'testuser.store\') }}">
        @csrf
        <div class="row justify-content-center">
            @include(\'testuser._form\')
        </div>
    </form>
</div>

@endsection';
