<!DOCTYPE html>
<html>

<head>
    <title>My Portfolio</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body {
            background: -webkit-linear-gradient(bottom, #2dbd6e, #a6f77b);
            background-repeat: no-repeat;
            font-family: "Raleway", sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .card {
            background: #fbfbfb;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
        }

        .alert {
            background: #fff3cd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            font-family: "Raleway Thin", sans-serif;
            letter-spacing: 2px;
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
            color: white;
        }

        a {
            text-decoration: none;
            color: #2dbd6e;
            transition: 0.25s;
        }

        a:hover {
            color: #24c64f;
        }

        .action-button {
            background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
            border: none;
            border-radius: 21px;
            box-shadow: 0px 1px 8px #24c64f;
            cursor: pointer;
            color: white;
            font-family: "Raleway SemiBold", sans-serif;
            padding: 10px 20px;
            transition: 0.25s;
            display: inline-block;
            margin: 5px;
        }

        .action-button:hover {
            box-shadow: 0px 1px 18px #24c64f;
            color: white;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #fbfbfb;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .welcome-text {
            color: #2c3e50;
            font-family: "Raleway", sans-serif;
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="nav-bar">
        <div>
            <h1>My Portfolio</h1>
            <!-- <p class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user']['Fullname'] ?? 'User'); ?> -->
            </p>
        </div>
        <div>
            <a href="index.php?controller=portefeuille&action=settings" class="action-button">Settings</a>
            <a href="index.php?controller=user&action=logout" class="action-button">Logout</a>
        </div>
    </div>

    <?php if (isset($firstTime) && $firstTime): ?>
        <div class="card">
            <div class="alert">
                <p>Welcome! Please set your initial salary to get started.</p>
                <form method="post" action="index.php?controller=portefeuille&action=updateSalary">
                    <div>
                        <label>Enter your salary:</label>
                        <input type="number" name="Salaire" required>
                    </div>
                    <button type="submit" class="action-button">Set</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Portfolio Details</h2>
        <p>Name: <?php echo htmlspecialchars($_SESSION['user']['Fullname'] ?? 'Unknown'); ?></p>
        <p>Balance: <?php
        $withSaving = ($portefeuille['TotalIncome'] * (1 - ($portefeuille['SavingPourcentage'] ?? 0) / 100)) - $totalCharges;
        $_SESSION['user']['BalanceWithSaving'] = $withSaving;
        echo htmlspecialchars($withSaving ?? 0); ?> DH
            (<?php echo htmlspecialchars($portefeuille['Solde'] ?? 0); ?> DH without saving)</p>
        <p>Total Charges for this month: <?php echo htmlspecialchars($totalCharges ?? 0); ?> DH</p>
    </div>

    <?php if (isset($savingsWarning) && $savingsWarning !== null && $savingsWarning['hasVariableCharges']): ?>
        <div class="card">
            <div class="alert">
                <p><strong>Warning:</strong> Your expenses exceed your available budget.</p>
                <p>Suggested reductions based on your historical spending:</p>

                <table>
                    <thead>
                        <tr>
                            <th>Charge Name</th>
                            <th>Description</th>
                            <th>Current Amount</th>
                            <th>Historical Minimum</th>
                            <th>Suggested Amount</th>
                            <th>Total Reduction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($savingsWarning['variableCharges'] as $charge): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($charge['NomCharge']); ?></td>
                                <td><?php echo htmlspecialchars($charge['Description']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($charge['CurrentMontant'], 2)); ?> DH</td>
                                <td><?php echo htmlspecialchars(number_format($charge['HistoricalMin'] ?? $charge['CurrentMontant'], 2)); ?>
                                    DH</td>
                                <td>
                                    <?php echo htmlspecialchars(number_format($charge['suggestedAmount'], 2)); ?> DH
                                    <?php if ($charge['additionalReduction'] > 0): ?>
                                        <br><small>(Additional <?php echo $charge['additionalReduction']; ?>% reduction
                                            needed)</small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars(number_format($charge['CurrentMontant'] - $charge['suggestedAmount'], 2)); ?>
                                    DH</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong><?php echo htmlspecialchars(number_format($savingsWarning['totalCurrent'], 2)); ?>
                                    DH</strong></td>
                            <td><strong><?php echo htmlspecialchars(number_format($savingsWarning['totalAfterHistoricalMin'], 2)); ?>
                                    DH</strong></td>
                            <td><strong><?php echo htmlspecialchars(number_format($savingsWarning['totalFinal'], 2)); ?>
                                    DH</strong></td>
                            <td><strong><?php echo htmlspecialchars(number_format($savingsWarning['totalCurrent'] - $savingsWarning['totalFinal'], 2)); ?>
                                    DH</strong></td>
                        </tr>
                    </tbody>
                </table>

                <p>
                    <strong>Total reduction needed:
                        <?php echo htmlspecialchars($savingsWarning['totalReductionPercentage']); ?>%</strong>
                    <?php if ($savingsWarning['additionalReductionNeeded'] > 0): ?>
                        <br>Even after reducing to historical minimums, an additional
                        <?php echo htmlspecialchars($savingsWarning['additionalReductionNeeded']); ?>% reduction is needed.
                    <?php endif; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Recent Charges</h2>
        <table>
            <thead>
                <tr>
                    <th>NomCharge</th>
                    <th>Montant</th>
                    <th>DateCharge</th>
                    <th>Variable</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentCharges as $charge): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($charge['NomCharge']); ?></td>
                        <td><?php echo htmlspecialchars($charge['Montant']); ?></td>
                        <td><?php echo htmlspecialchars($charge['DateCharge']); ?></td>
                        <td><?php echo htmlspecialchars($charge['Variable'] == 1 ? 'Variable' : 'Fixe'); ?></td>
                        <td><?php echo htmlspecialchars($charge['Description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?controller=charges&action=index" class="action-button">View All Charges</a>
    </div>
</body>

</html>