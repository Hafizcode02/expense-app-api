<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - EXPENSE APP</title>
</head>

<body>
    <h2>API Expense App</h2>
    <p>Created by Hafiz Caniago - 2023</p>

    <h3>Route : </h3>
    <p>[GET] Get All Expenses Data - https://expense-app.hafizcaniago.my.id/api/index.php?route=expenses&id={USER_ID}</p>
    <p>[GET] Get All Expense Price - https://expense-app.hafizcaniago.my.id/api/index.php?route=expenses/count&id={USER_ID}</p>
    <p>[POST] CREATE Expense Data - https://expense-app.hafizcaniago.my.id/api/index.php?route=expense</p>
    <p>[GET] Get Expense Data - https://expense-app.hafizcaniago.my.id/api/index.php?route=expense&id={EXPENSE_DATA_ID}</p>
    <p>[PUT] Update Expense Data - https://expense-app.hafizcaniago.my.id/api/index.php?route=expense&id={EXPENSE_DATA_ID}</p>
    <p>[DELETE] Get All Routes - https://expense-app.hafizcaniago.my.id/api/index.php?route=expense&id={EXPENSE_DATA_ID}</p>

    <br>
    <p>
        Notes : <br>
        {EXPENSE_DATA_ID} = Replace with Id of Expense Data <br>
        {USER_ID} = Replace with Your User ID
    </p>
</body>

</html>