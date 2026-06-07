<!DOCTYPE html>
<html>
<head>
    <title>Test Login</title>
</head>
<body>

<form id="loginForm">
    <input type="email" id="email" placeholder="Email"><br><br>

    <input type="password" id="password" placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {

    e.preventDefault();

    const response = await fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type':'application/json',
            'Accept':'application/json'
        },
        body: JSON.stringify({
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
    });

    const data = await response.json();

    console.log(data);
    alert(JSON.stringify(data));
});
</script>

</body>
</html>