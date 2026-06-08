<!DOCTYPE html>
<html>
<head>
    <title>Test Internship Offer</title>
</head>
<body>

<h2>Create Internship Offer (TEST)</h2>

<form method="POST" action="/test-internship-offer">
    @csrf

    <input name="token" placeholder="Bearer token"><br><br>

    <input name="title"><br><br>
    <input name="description"><br><br>
    <input name="duration"><br><br>
    <input name="location"><br><br>
    <input name="required_skills"><br><br>
    <input name="deadline" type="date"><br><br>

    <button type="submit">Create Offer</button>
</form>

</body>
</html>