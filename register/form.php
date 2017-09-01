

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <label>Име </label><input type="text" maxlength="10" id="name" name="name"  required><br/>
    <label>Фамилия </label><input type="text" maxlength="10" value="" name="family" required><br/>
    <label>Em@il </label><input type="text"  value="" name="mail" required><br/>
    <label>Tелефон </label><input type="tel"  name="phone" required><br/>
    <label>Парола </label><input type="password"  name="pass1" required><br/>
    <label>Повтърди паролата </label><input type="password" name="pass2" required><br/>
    <input type="submit" name="button" value="Изпрати">
</form>
<form method="post">
    <input type="submit" name="show" value="Давай ми всички коита са се регистрирали">
</form>
</body>
</html>