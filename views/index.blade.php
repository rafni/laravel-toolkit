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
                    <p>There are {{ $ReplacePlural->lastPage() }} pages for a total of {{ $ReplacePlural->total() }} records</p>
                    {{ Html::linkRoute('ReplaceSingular.create', 'Create new', ['class' => 'btn btn-primary']) }}
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Column 1</th>
                                <th>Column 2</th>
                                <th>Column 3</th>
                                <th>Actions</th>
                            </tr>
                            @if ($ReplacePlural->total() < 1)
                            <tr>
                                <td colspan="3">No records found</td>
                            </tr>
                            @endif
                            @foreach ($ReplacePlural as $ReplaceSingular)
                            <tr>
                                <td>{{ $ReplaceSingular->property1 }}</td>
                                <td>{{ $ReplaceSingular->property2 }}</td>
                                <td>{{ $ReplaceSingular->property3 }}</td>
                                <td>
                                    {!! Form::open(['route' => ['ReplaceSingular.delete', $ReplaceSingular->id], 'method' => 'delete']) !!}
                                    {!! Html::linkRoute('ReplaceSingular.edit', 'Edit', ['id' => $ReplaceSingular->id], ['class' => 'btn btn-primary']) !!}
                                    {!! Html::linkRoute('ReplaceSingular.show', 'Show', ['id' => $ReplaceSingular->id], ['class' => 'btn btn-info']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    {!! $ReplacePlural->render() !!}
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>