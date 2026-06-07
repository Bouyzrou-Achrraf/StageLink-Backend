<!DOCTYPE html>
<html>
<head>
    <title>Test Register</title>
</head>
<body>

<form id="registerForm">
    <input type="text" id="name" placeholder="Name"><br><br>

    <input type="email" id="email" placeholder="Email"><br><br>

    <input type="password" id="password" placeholder="Password"><br><br>

    <input type="password" id="password_confirmation" placeholder="Confirm Password"><br><br>

    <select id="role">
        <option value="student">Student</option>
        <option value="company">Company</option>
    </select><br><br>

    <button type="submit">Register</button>
</form>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const response = await fetch('/api/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
            role: document.getElementById('role').value
        })
    });

    const data = await response.json();

    console.log(data);
    alert(JSON.stringify(data));
});
</script>

</body>
</html>