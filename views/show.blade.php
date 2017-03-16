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
                    <div class="form-horizontal">
                        <div class="form-group">
                            {{ Form::label('example1', 'Example 1', ['class' => 'control-label col-sm-2']) }}
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $ReplaceSingular->example1 }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('example2', 'Example 2', ['class' => 'control-label col-sm-2']) }}
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $ReplaceSingular->example2 }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('example3', 'Example 3', ['class' => 'control-label col-sm-2']) }}
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $ReplaceSingular->example3 }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Html::linkRoute('ReplaceSingular.index', 'Back', [], ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>