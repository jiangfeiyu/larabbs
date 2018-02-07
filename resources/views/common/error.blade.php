@if (count($errors) > 0)
    <div class="alert alert-danger" style="margin-top: 5px;">
        <h4>错误：</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif