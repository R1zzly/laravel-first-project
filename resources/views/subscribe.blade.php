<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
</head>
<body>
<form action="/subscribe" method="POST">
    @csrf
    <label for="plan">Choose a plan:</label>
    <select name="plan_id" id="plan">
        <option value="basic_monthly">Basic Monthly - $10</option>
        <option value="basic_yearly">Basic Yearly - $100</option>
        <option value="premium_monthly">Premium Monthly - $20</option>
        <option value="premium_yearly">Premium Yearly - $200</option>
    </select>

    <button type="submit">Subscribe</button>
</form>
</body>
</html>
