<!DOCTYPE html>
<html>

<head>
    <title>Read Tasks Data</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Read Tasks </h1>
            <br>


        </div>

        <a href="{{ url('tasks/create') }}">+ Task</a>
        {{-- <a href="{{ url('Logout') }}">Logout</a> --}}


        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Added By</th>

                <th>Action</th>
            </tr>


            @foreach ($data as $key => $task)
                <tr>

                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ Str::limit($task->content, 50, '...') }}</td>
                    <td><img src="{{ url('images/' . $task->image) }}" width="80px" height="80px"></td>
                    <td>{{ date('Y-m-d', $task->start_date) }}</td>
                    <td>{{ date('Y-m-d', $task->end_date) }}</td>
                    <td>{{ $task->name }}</td>

                    <td>
                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $task->id }}"
                            class='btn btn-danger m-r-1em'>Remove Task</a>
                        <a href='{{ url('tasks/edit/' . $task->id) }}' class='btn btn-primary m-r-1em'>Edit</a>
                    </td>
                </tr>
                <div class="modal" id="modal_single_del{{ $task->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                Remove Task : {{ $task->title }} !!!!
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('tasks/' . $task->id) }}" method="post">

                                    @method('delete') {{-- <input type="hidden" name="_method" value="delete"> --}}
                                    @csrf

                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
