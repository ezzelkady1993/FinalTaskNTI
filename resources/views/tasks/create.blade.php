<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task | Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <h2>Add Task</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- @include('messages') --}}


        <form action="<?php echo url('tasks'); ?>" method="post" enctype="multipart/form-data">

            @csrf


            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title"
                    placeholder="Enter Title" value="{{ old('title') }}">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content"
                    placeholder="Enter Content"> {{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Start Date</label>
                <input type="date" class="form-control" id="exampleInput" name="start_date">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">End Date</label>
                <input type="date" class="form-control" id="exampleInput" name="end_date">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Added By</label>
                <select class="form-control" required name="added_by">
                    @foreach ($data as $key => $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>


</body>

</html>
