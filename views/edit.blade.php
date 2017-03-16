<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="@yield('description')" />
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::model($ReplaceSingular, ['route' => ['ReplaceSingular.update', $ReplaceSingular], 'class' => 'form-horizontal', 'method' => 'put']) }}
                        <div class="form-group">
                            {{ Form::label('example1', 'Example 1', ['class' => 'control-label']) }}
                            {{ Form::text('example1', old('example1'), ['class' => 'form-control', 'placeholder' => 'Example 1']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('example2', 'Example 2', ['class' => 'control-label']) }}
                            {{ Form::text('example2', old('example2'), ['class' => 'form-control', 'placeholder' => 'Example 2']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('example3', 'Example 3', ['class' => 'control-label']) }}
                            {{ Form::text('example3', old('example3'), ['class' => 'form-control', 'placeholder' => 'Example 3']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            {{ Html::linkRoute('ReplaceSingular.index', 'Go back', [], ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>