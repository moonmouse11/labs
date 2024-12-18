<html>
<head>
<style>
h1 {text-align: center;}
h2 {text-align: center;}
p {text-align: center;}
div {text-align: center;}
</style>
</head>
<body>
<h1> Main Title Lab 4 </h1>

<h2> First Form </h2>

<form action="../../index.php" method="post" style="text-align: center">
    <label for="username">Username:</label>
    <input name="username" id="username" type="text" required>

    <label for="password">Password:</label>
    <input name="password" id="password" type="password" required>

    <button type="submit">Login</button>
</form>

<h2> Second Form </h2>

<form action="../../index.php" method="get" style="text-align: center">
    <label for="brand">Brand:</label>
    <input name="brand" id="brand" type="text" required>

    <button type="submit">Search</button>
</form>

<h2> Third Form </h2>

<form action="../../index.php" method="get" style="text-align: center">
    <label for="number">Place Number:</label>
    <input name="number" id="number" type="number" required>

    <button type="submit">Search</button>
</form>
</body>
</html>