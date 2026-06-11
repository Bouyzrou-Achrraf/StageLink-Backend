<!DOCTYPE html>
<html>
<head>
    <title>My Applications</title>
</head>
<body>

<h2>View My Applications</h2>

<form method="POST" action="/test-my-applications">
    @csrf

    <input
        type="text"
        name="token"
        placeholder="Student Token"
        style="width:500px;"
    >

    <br><br>

    <button type="submit">
        Show My Applications
    </button>

</form>

</body>
</html>