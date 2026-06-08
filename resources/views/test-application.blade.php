<!DOCTYPE html>
<html>
<head>
    <title>Test Application</title>
</head>
<body>

<h2>Apply for Internship (TEST)</h2>

<form method="POST" action="/test-application">
    @csrf

    <input name="token" placeholder="Student token"><br><br>

    <input name="internship_offer_id" placeholder="Offer ID"><br><br>

    <button type="submit">Apply</button>
</form>

</body>
</html>