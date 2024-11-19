<!DOCTYPE html>
<html>

<head>
    <title>Charges - My Portfolio</title>
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

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
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

        h1,
        h2 {
            font-family: "Raleway Thin", sans-serif;
            letter-spacing: 2px;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
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
            text-decoration: none;
        }

        .action-button:hover {
            box-shadow: 0px 1px 18px #24c64f;
            color: white;
        }

        .edit-button {
            background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
            border: none;
            border-radius: 21px;
            color: white;
            padding: 5px 10px;
            transition: 0.25s;
            display: inline-block;
            margin: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-button:hover {
            background: -webkit-linear-gradient(right, #2dbd6e, #a6f77b);
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-family: "Raleway", sans-serif;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            font-family: "Raleway", sans-serif;
        }

        .delete-button {
            background: #dc3545;
            border: none;
            border-radius: 21px;
            padding: 5px 10px;
            color: white;
            cursor: pointer;
            transition: 0.25s;
        }

        .delete-button:hover {
            background: #c82333;
        }

        .filters {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filters select {
            flex: 1;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin: 10px 0;
            align-items: center;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #2dbd6e;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
        }

        .radio-option input[type="radio"]:checked {
            background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
            border: 2px solid #2dbd6e;
            position: relative;
        }

        .radio-option input[type="radio"]:checked::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .radio-option label {
            display: inline;
            margin: 0;
            cursor: pointer;
        }

        .date-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-group label {
            margin: 0;
            min-width: 50px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .modal-content {
            background: #fbfbfb;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            position: relative;
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #2dbd6e;
        }
    </style>
</head>

<body>
    <div class="nav-bar">
        <div>
            <h1>Charges Management</h1>
            <!-- <p class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user']['Fullname'] ?? 'User'); ?> -->
            </p>
        </div>
        <div>
            <a href="index.php?controller=portefeuille&action=index" class="action-button">Back to Dashboard</a>
            <a href="index.php?controller=user&action=logout" class="action-button">Logout</a>
        </div>
    </div>

    <div class="card">
        <button class="action-button" onclick="openModal()">Add New Charge</button>
        <h2>Your Charges</h2>
        <div class="filters">
            <select id="typeFilter">
                <option value="all">All Types</option>
                <option value="fixed">Fixed</option>
                <option value="variable">Variable</option>
            </select>
            <select id="monthFilter">
                <option value="all">All Months</option>
                <!-- Add month options dynamically if needed -->
            </select>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($charges as $charge): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($charge['NomCharge']); ?></td>
                        <td><?php echo htmlspecialchars($charge['Description']); ?></td>
                        <td><?php echo htmlspecialchars($charge['Montant']); ?> DH</td>
                        <td><?php echo htmlspecialchars($charge['Variable'] == 1 ? 'Variable' : 'Fixe'); ?></td>
                        <td><?php echo htmlspecialchars($charge['DateCharge']); ?></td>
                        <td>
                            <form method="post" action="index.php?controller=charges&action=delete"
                                style="display: flex; align-items: center; justify-content: center;">
                                <input type="hidden" name="id" value="<?php echo $charge['CodeCharge']; ?>">
                                <button type="button" class="edit-button"
                                    onclick="openEditModal(<?php echo $charge['CodeCharge']; ?>)">Edit</button>
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="chargeModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2>Add New Charge</h2>
            <form method="post" action="index.php?controller=charges&action=create" class="form-group">
                <div>
                    <input type="hidden" name="CodePortefeuille"
                        value="<?php echo htmlspecialchars($_SESSION['user']['CodePortefeuille']); ?>">
                </div>
                <div>
                    <label>Nom de la charge:</label>
                    <input type="text" name="NomCharge" required>
                </div>
                <div>
                    <label>Description:</label>
                    <input type="text" name="Description" required>
                </div>
                <div>
                    <label>Amount:</label>
                    <input type="number" name="Montant" required>
                </div>
                <div>
                    <div class="radio-group">
                        <label>Type:</label>
                        <div class="radio-option">
                            <input type="radio" id="variable" name="Variable" value="1" required>
                            <label for="variable">Variable</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="fixe" name="Variable" value="0">
                            <label for="fixe">Fixe</label>
                        </div>
                    </div>
                </div>
                <div class="date-group">
                    <label>Date:</label>
                    <input type="date" name="DateCharge" required id="chargeDate">
                </div>
                <button type="submit" class="action-button">Add Charge</button>
            </form>
        </div>
    </div>

    <script>
        // Set default date to today
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('chargeDate').value = today;
        });

        // Modal functions
        function openModal() {
            document.getElementById('chargeModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function openEditModal(chargeId) {
            document.getElementById('chargeModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
            document.getElementById('chargeId').value = chargeId;

        }

        function closeModal() {
            document.getElementById('chargeModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('chargeModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>