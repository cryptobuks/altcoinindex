@if($artisan_output)

    <pre>
       <i class="close-output voyager-x">clear output</i><span class="art_out">Artisan Command Output:</span>{{ trim(trim($artisan_output,'"')) }}
    </pre>
@endif

@foreach($commands as $command)
	<div class="command" data-command="{{ $command->name }}">
		<code>php artisan {{ $command->name }}</code>
		<small>{{ $command->description }}</small><i class="voyager-terminal"></i>
		<form action="{{ route('voyager.compass.post') }}" class="cmd_form" method="POST">
            {{ csrf_field() }}
            <input type="text" name="args" autofocus class="form-control" placeholder="Additional Args?">
            <input type="submit" class="btn btn-primary pull-right delete-confirm"
                     value="Run Command">
            <input type="hidden" name="command" id="hidden_cmd" value="{{ $command->name }}">
        </form>
        
	</div>
@endforeach