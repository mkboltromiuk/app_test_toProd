<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
</head>
<body>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="name">Project Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create Project</button>
    </form>
</body>
</html>
