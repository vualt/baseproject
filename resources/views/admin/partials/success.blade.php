@if($message = Session::get('success'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <strong>
            <i class="fa fa-check-circle fa-lg fa-fw"></i> Success. &nbsp;
        </strong>
        {{ $message }}
    </div>
@endif