<!DOCTYPE html>
<html>
<head>
    <title>Test Internship Offer</title>
</head>
<body>

<h2>Create Internship Offer (TEST)</h2>

<form method="POST" action="{{ url('/test-internship-offer') }}">
    @csrf

    <input name="title" placeholder="Title"><br><br>
    <input name="description" placeholder="Description"><br><br>
    <input name="duration" placeholder="Duration"><br><br>
    <input name="location" placeholder="Location"><br><br>
    <input name="required_skills" placeholder="Skills"><br><br>
    <input name="deadline" type="date"><br><br>

    <button type="submit">Create Offer</button>
</form>

</body>
</html>