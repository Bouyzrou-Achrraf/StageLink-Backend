<!DOCTYPE html>
<html>
<head>
    <title>Update Application</title>
</head>
<body>

<h2>Accept / Reject Application</h2>

<form method="POST" action="/test-update-application">
    @csrf

    <input
        type="text"
        name="token"
        placeholder="Company Token"
        style="width:500px;"
    >

    <br><br>

    <input
        type="number"
        name="application_id"
        placeholder="Application ID"
    >

    <br><br>

    <select name="status">
        <option value="accepted">Accepted</option>
        <option value="rejected">Rejected</option>
    </select>

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

</body>
</html>